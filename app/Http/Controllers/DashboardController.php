<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use App\Models\DocumentProgress;

class DashboardController extends Controller
{
    public function index()
    {
        $totalDocument = Document::count();
        $totalDocumentType = DocumentType::count();

        // Hitung progress global
        $completedProgress = DocumentProgress::where('is_checked', true)->count();
        $totalProgress = DocumentProgress::count();
        $progressPercentage = $totalProgress > 0 ? round(($completedProgress / $totalProgress) * 100, 2) : 0;

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

        // === tambahan baru ===
        // Dokumen belum selesai
        $unfinishedDocuments = Document::whereDoesntHave('progresses', function ($q) {
            $q->where('is_checked', true);
        })->count();


        // Dokumen tanpa progress sama sekali
        $noProgressDocs = Document::doesntHave('progresses')->count();

        return view('backend.dashboard.index', compact(
            'totalDocument',
            'totalDocumentType',
            'completedProgress',
            'progressPercentage',
            'documentsByType',
            'latestDocuments',
            'topDocumentTypes',
            'topDocuments',
            'recentActivities',
            'unfinishedDocuments',
            'noProgressDocs'
        ));
    }
}
