<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use App\Models\DocumentProgress;
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

    public function updateMultiple(Request $request, $documentId)
    {
        foreach ($request->progress as $id => $data) {
            $progress = DocumentProgress::find($id);
            if ($progress) {
                $progress->update([
                    'is_checked' => isset($data['is_checked']),
                    'checked_at' => isset($data['is_checked']) ? now() : null,
                    'description' => $data['description'] ?? null,
                    'checked_by' => auth()->id(),
                ]);
            }
        }

        return redirect()->route('progress.show', $documentId)->with('success', 'Progress berhasil diperbarui');
    }
}
