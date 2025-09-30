<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentType;
use App\Models\DocumentWorkflow;
use App\Models\DocumentProgress;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::with('type')
            ->latest()
            ->paginate(10);

        return view('backend.documents.index', compact('documents'));
    }


    public function create()
    {
        $types = DocumentType::all();
        return view('backend.documents.create', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nama_dokumen' => 'required',
            'jenis_id' => 'required|exists:document_types,id',
            'tanggal_diterima' => 'required|date',
            'file_path' => 'nullable|file',
        ]);

        $data = $request->all();
        if ($request->hasFile('file_path')) {
            $data['file_path'] = $request->file('file_path')->store('documents', 'public');
        }

        $document = Document::create($data);

        $workflows = DocumentWorkflow::where('document_type_id', $document->jenis_id)->get();
        foreach ($workflows as $wf) {
            DocumentProgress::create([
                'document_id' => $document->id,
                'workflow_id' => $wf->id,
            ]);
        }

        return redirect()->route('documents.index')->with('success', 'Dokumen berhasil ditambahkan.');
    }

    public function edit(Document $document)
    {
        $types = DocumentType::all();
        return view('backend.documents.edit', compact('document', 'types'));
    }

    public function update(Request $request, Document $document)
    {
        $request->validate([
            'nama' => 'required',
            'nama_dokumen' => 'required',
            'jenis_id' => 'required|exists:document_types,id',
            'tanggal_diterima' => 'required|date',
            'file_path' => 'nullable|file',
        ]);

        $data = $request->all();
        if ($request->hasFile('file_path')) {
            $data['file_path'] = $request->file('file_path')->store('documents', 'public');
        }

        $document->update($data);

        return redirect()->route('documents.index')->with('success', 'Dokumen berhasil diperbarui.');
    }

    public function destroy(Document $document)
    {
        $document->delete();
        return redirect()->route('documents.index')->with('success', 'Dokumen berhasil dihapus.');
    }
}
