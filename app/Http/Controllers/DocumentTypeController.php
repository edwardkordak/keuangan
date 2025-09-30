<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use Illuminate\Http\Request;

class DocumentTypeController extends Controller
{
    public function index()
    {
        $types = DocumentType::all();
        return view ('backend.types.index', compact('types'));
    }

    public function create()
    {
        return view('backend.types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:document_types,kode',
            'nama' => 'required',
        ]);

        DocumentType::create($request->all());
        return redirect()->route('types.index')->with('success', 'Jenis dokumen berhasil ditambahkan.');
    }

    public function edit(DocumentType $type)
    {
        return view('backend.types.edit', compact('type'));
    }

    public function update(Request $request, DocumentType $type)
    {
        $request->validate([
            'kode' => 'required|unique:document_types,kode,' . $type->id,
            'nama' => 'required',
        ]);

        $type->update($request->all());
        return redirect()->route('types.index')->with('success', 'Jenis dokumen berhasil diperbarui.');
    }

    public function destroy(DocumentType $type)
    {
        $type->delete();
        return redirect()->route('types.index')->with('success', 'Jenis dokumen berhasil dihapus.');
    }
}
