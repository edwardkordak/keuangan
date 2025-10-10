<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use App\Models\DocumentProgress;
use App\Models\DocumentWorkflow;
use Illuminate\Support\Facades\Auth;

class DocumentProgressController extends Controller
{
    public function index()
    {
        $progress = DocumentProgress::with(['document', 'workflow'])->latest()->get();
        return view('backend.progress.index', compact('progress'));
    }

    public function edit(DocumentProgress $progress)
    {
        return view('backend.progress.edit', compact('progress'));
    }

    public function update(Request $request, DocumentProgress $progress)
    {
        $request->validate([
            'is_checked' => 'boolean',
            'description' => 'nullable|string',
        ]);

        $progress->update([
            'is_checked' => $request->has('is_checked') ? true : false,
            'checked_at' => $request->has('is_checked') ? now() : null,
            'description' => $request->description,
            'checked_by' => Auth::id(),
        ]);

        return redirect()->route('documents.index')->with('success', 'Progress dokumen diperbarui.');
    }

    public function show($documentId)
    {
        $document = Document::with(['progresses.workflow'])->findOrFail($documentId);
        return view('backend.progress.show', compact('document'));
    }

    // public function updateMultiple(Request $request, $documentId)
    // {
    //     foreach ($request->progress as $id => $data) {
    //         $progress = DocumentProgress::find($id);
    //         if ($progress) {
    //             $progress->update([
    //                 'is_checked' => isset($data['is_checked']),
    //                 'checked_at' => isset($data['is_checked']) ? now() : null,
    //                 'description' => $data['description'] ?? null,
    //                 'checked_by' => auth()->id(),
    //             ]);
    //         }
    //     }

    //     return redirect()->route('progress.show', $documentId)->with('success', 'Progress berhasil diperbarui');
    // }
    public function updateMultiple(Request $request, $documentId)
    {
        // Ambil semua workflow step untuk dokumen ini (urut berdasarkan step_number)
        $workflows = DocumentWorkflow::orderBy('step_number')->get();

        foreach ($request->progress as $id => $data) {
            $progress = DocumentProgress::find($id);

            if ($progress) {
                $isCheckedNow = isset($data['is_checked']);
                $isCheckedBefore = $progress->is_checked;

                // ===== CEK URUTAN STEP =====
                if ($isCheckedNow && !$isCheckedBefore) {
                    // Ambil step saat ini
                    $currentWorkflow = $workflows->firstWhere('id', $progress->workflow_id);

                    // Cari semua step sebelum step ini
                    $previousSteps = $workflows->where('step_number', '<', $currentWorkflow->step_number);

                    // Cek apakah semua step sebelumnya sudah checked
                    $incompletePrev = DocumentProgress::where('document_id', $documentId)
                        ->whereIn('workflow_id', $previousSteps->pluck('id'))
                        ->where('is_checked', false)
                        ->exists();

                    if ($incompletePrev) {
                        return redirect()
                            ->route('progress.show', $documentId)
                            ->with('error', 'Tidak dapat menyelesaikan ' . $currentWorkflow->step_name .
                                ' sebelum semua step sebelumnya selesai.');
                    }
                }

                // ===== CEK UNCHECK MUNDUR =====
                if (!$isCheckedNow && $isCheckedBefore) {
                    // Kalau step ini di-uncheck, maka semua step setelahnya harus ikut uncheck
                    $currentWorkflow = $workflows->firstWhere('id', $progress->workflow_id);
                    $nextSteps = $workflows->where('step_number', '>', $currentWorkflow->step_number);

                    DocumentProgress::where('document_id', $documentId)
                        ->whereIn('workflow_id', $nextSteps->pluck('id'))
                        ->update([
                            'is_checked' => false,
                            'checked_at' => null,
                            'checked_by' => auth()->id(),
                        ]);
                }

                // ===== UPDATE STEP SEKARANG =====
                $checkedAt = $progress->checked_at;

                if (!$isCheckedBefore && $isCheckedNow) {
                    $checkedAt = now();
                } elseif ($isCheckedBefore && !$isCheckedNow) {
                    $checkedAt = null;
                }

                $progress->update([
                    'is_checked' => $isCheckedNow,
                    'checked_at' => $checkedAt,
                    'description' => $data['description'] ?? null,
                    'checked_by' => auth()->id(),
                ]);
            }
        }

        return redirect()
            ->route('progress.show', $documentId)
            ->with('success', 'Progress berhasil diperbarui');
    }
}
