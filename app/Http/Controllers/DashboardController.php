<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use App\Models\DocumentProgress;
use App\Models\DocumentWorkflow;

class DashboardController extends Controller
{
    public function index()
    {
        $totalDocument = Document::count();
        $totalDocumentType = DocumentType::count();

        // Ambil workflow ID dari tahap "Penerbitan SP2D"
        $sp2dStepIds = DocumentWorkflow::where('step_name', 'Penerbitan SP2D')->pluck('id');

        // === Jumlah dokumen yang SUDAH SP2D ===
        $completedDocuments = Document::whereHas('progresses', function ($q) use ($sp2dStepIds) {
            $q->whereIn('workflow_id', $sp2dStepIds)
                ->where('is_checked', true);
        })->count();

        // === Jumlah dokumen yang BELUM SP2D ===
        $unfinishedDocuments = Document::where(function ($q) use ($sp2dStepIds) {
            $q->whereDoesntHave('progresses', function ($sub) use ($sp2dStepIds) {
                $sub->whereIn('workflow_id', $sp2dStepIds)
                    ->where('is_checked', true);
            });
        })->count();

        // Dokumen tanpa progress sama sekali (opsional jika mau ditampilkan terpisah)
        $noProgressDocs = Document::doesntHave('progresses')->count();

        // Dokumen per jenis
        $documentsByType = DocumentType::withCount('documents')->get();

        // Dokumen terbaru
        $latestDocuments = Document::with('type')->latest()->take(5)->get();

        // Top jenis dokumen
        $topDocumentTypes = DocumentType::withCount('documents')
            ->orderByDesc('documents_count')
            ->take(5)
            ->get();

        // Dokumen dengan progress paling banyak selesai
        $topDocuments = Document::withCount(['progresses as checked_count' => function ($q) {
            $q->where('is_checked', true);
        }])
            ->orderByDesc('checked_count')
            ->take(5)
            ->get();

        // Aktivitas terakhir
        $recentActivities = DocumentProgress::with(['document.type', 'checkedBy'])
            ->latest('checked_at')
            ->take(5)
            ->get();

        return view('backend.dashboard.index', compact(
            'totalDocument',
            'totalDocumentType',
            'completedDocuments',
            'unfinishedDocuments',
            'noProgressDocs',
            'documentsByType',
            'latestDocuments',
            'topDocumentTypes',
            'topDocuments',
            'recentActivities'
        ));
    }

public function chartData(Request $request)
{
    $typeId = $request->get('type_id');

    // Ambil semua step urut
    $steps = DocumentWorkflow::where('document_type_id', $typeId)
        ->orderBy('step_number')
        ->get(['id', 'step_name', 'step_number']);

    if ($steps->isEmpty()) {
        return response()->json([]);
    }

    // Ambil semua dokumen
    $documents = Document::where('jenis_id', $typeId)
        ->with(['progresses' => function ($q) use ($steps) {
            $q->whereIn('workflow_id', $steps->pluck('id'))
                ->where('is_checked', true);
        }])
        ->get(['id', 'nama_dokumen']);

    // Tentukan step terakhir untuk setiap dokumen
    $latestPerDoc = $documents->map(function ($doc) use ($steps) {
        if ($doc->progresses->isEmpty()) {
            // Belum ada progress -> step pertama
            return [
                'document_id' => $doc->id,
                'nama_dokumen' => $doc->nama_dokumen,
                'last_step_id' => $steps->first()->id,
            ];
        }

        // Ambil step terakhir berdasarkan step_number tertinggi
        $lastStep = $doc->progresses
            ->map(fn($p) => $steps->firstWhere('id', $p->workflow_id))
            ->filter()
            ->sortByDesc('step_number')
            ->first();

        return [
            'document_id' => $doc->id,
            'nama_dokumen' => $doc->nama_dokumen,
            'last_step_id' => $lastStep ? $lastStep->id : $steps->first()->id,
        ];
    });

    // Hitung jumlah per step & sertakan daftar dokumen
    $grouped = collect($latestPerDoc)->groupBy('last_step_id')->map(function ($group) {
        return [
            'count' => $group->count(),
            'documents' => $group->pluck('nama_dokumen')->values(),
        ];
    });

    // Format hasil untuk chart (plus debug dokumen)
    $chartData = $steps->map(function ($step) use ($grouped) {
        $data = $grouped[$step->id] ?? ['count' => 0, 'documents' => []];
        return [
            'step' => $step->step_name,
            'count' => $data['count'],
            'documents' => $data['documents'], // tambahan debug
        ];
    });

    return response()->json($chartData);
}


}
