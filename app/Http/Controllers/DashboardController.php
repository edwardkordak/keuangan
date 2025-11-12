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

    // public function chartData(Request $request)
    // {
    //     $typeId = $request->get('type_id');

    //     // Ambil semua step urut (misalnya: Dokumen diterima, Verifikasi, SP2D, dst)
    //     $steps = DocumentWorkflow::where('document_type_id', $typeId)
    //         ->orderBy('step_number')
    //         ->get(['id', 'step_name', 'step_number']);

    //     if ($steps->isEmpty()) {
    //         return response()->json([]);
    //     }

    //     // Ambil semua dokumen dari tipe tersebut
    //     $documents = Document::where('jenis_id', $typeId)
    //         ->with(['progresses' => function ($q) use ($steps) {
    //             $q->whereIn('workflow_id', $steps->pluck('id'))
    //                 ->where('is_checked', true);
    //         }])
    //         ->get(['id']);

    //     // Tentukan step terakhir untuk setiap dokumen
    //     $latestPerDoc = $documents->map(function ($doc) use ($steps) {
    //         if ($doc->progresses->isEmpty()) {
    //             // Belum ada progress -> anggap di step pertama
    //             return $steps->first()->id;
    //         }

    //         // Ambil progress dengan step_number tertinggi
    //         $lastStep = $doc->progresses->map(function ($p) use ($steps) {
    //             return $steps->firstWhere('id', $p->workflow_id);
    //         })->sortByDesc('step_number')->first();

    //         return $lastStep ? $lastStep->id : $steps->first()->id;
    //     });

    //     // Hitung jumlah per step terakhir
    //     $counts = collect($latestPerDoc)->countBy();

    //     // Format hasil untuk chart
    //     $chartData = $steps->map(function ($step) use ($counts) {
    //         return [
    //             'step'  => $step->step_name,
    //             'count' => $counts[$step->id] ?? 0,
    //         ];
    //     });

    //     return response()->json($chartData);
    // }

    public function chartData(Request $request)
    {
        $typeId = $request->get('type_id');

        // Ambil semua step urut berdasarkan workflow tipe dokumen
        $steps = DocumentWorkflow::where('document_type_id', $typeId)
            ->orderBy('step_number')
            ->get(['id', 'step_name', 'step_number']);

        if ($steps->isEmpty()) {
            return response()->json([]);
        }

        // Ambil semua dokumen berdasarkan tipe
        $documents = Document::where('jenis_id', $typeId)
            ->pluck('id');

        // Ambil semua progress valid untuk dokumen tersebut
        $progress = DocumentProgress::whereIn('document_id', $documents)
            ->whereIn('workflow_id', $steps->pluck('id'))
            ->where('is_checked', true)
            ->get(['document_id', 'workflow_id']);

        // Tentukan step terakhir per dokumen
        $latestPerDoc = $documents->map(function ($docId) use ($progress, $steps) {
            $docProgress = $progress->where('document_id', $docId);

            if ($docProgress->isEmpty()) {
                // Tidak punya progress → step pertama
                return $steps->first()->id;
            }

            // Cari step_number tertinggi untuk dokumen ini
            $maxStep = $docProgress->map(function ($p) use ($steps) {
                return $steps->firstWhere('id', $p->workflow_id);
            })->filter()->sortByDesc('step_number')->first();

            return $maxStep ? $maxStep->id : $steps->first()->id;
        });

        // Hitung jumlah dokumen per step terakhir
        $counts = collect($latestPerDoc)->countBy();

        // Format hasil untuk chart
        $chartData = $steps->map(function ($step) use ($counts) {
            return [
                'step'  => $step->step_name,
                'count' => $counts[$step->id] ?? 0,
            ];
        });

        return response()->json($chartData);
    }
}
