<?php

namespace App\Http\Controllers;

use App\Models\DocumentWorkflow;
use App\Models\DocumentType;
use Illuminate\Http\Request;

class DocumentWorkflowController extends Controller
{
    public function index()
    {
        $workflows = DocumentWorkflow::with('type')->orderBy('document_type_id')->orderBy('step_number')->get();
        return view('backend.workflows.index', compact('workflows'));
    }

    public function create()
    {
        $types = DocumentType::all();
        return view('backend.workflows.create', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'document_type_id' => 'required|exists:document_types,id',
            'step_number' => 'required|integer',
            'step_name' => 'required',
        ]);

        DocumentWorkflow::create($request->all());
        return redirect()->route('workflows.index')->with('success', 'Workflow step berhasil ditambahkan.');
    }

    public function edit(DocumentWorkflow $workflow)
    {
        $types = DocumentType::all();
        return view('backend.workflows.edit', compact('workflow', 'types'));
    }

    public function update(Request $request, DocumentWorkflow $workflow)
    {
        $request->validate([
            'document_type_id' => 'required|exists:document_types,id',
            'step_number' => 'required|integer',
            'step_name' => 'required',
        ]);

        $workflow->update($request->all());
        return redirect()->route('workflows.index')->with('success', 'Workflow step berhasil diperbarui.');
    }

    public function destroy(DocumentWorkflow $workflow)
    {
        $workflow->delete();
        return redirect()->route('workflows.index')->with('success', 'Workflow step berhasil dihapus.');
    }
}
