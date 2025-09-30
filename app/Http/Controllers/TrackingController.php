<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentType;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function indexGup()
    {
        return view('pages.gup');
    }

    public function searchGup(Request $request)
    {
        return $this->searchByType($request, 'GUP'); // Jenis A
    }

    public function indexKkp()
    {
        return view('pages.kkp');
    }

    public function searchKkp(Request $request)
    {
        return $this->searchByType($request, 'KKP');
    }

    public function indexSpk()
    {
        return view('pages.spk');
    }

    public function searchSpk(Request $request)
    {
        // dd('Masuk ke searchGup dengan query: ' . $request->q);
        return $this->searchByType($request, 'SPK');
    }

    public function show($id)
    {
        $document = Document::with(['type', 'progresses.workflow'])->findOrFail($id);
        return view('pages.show', compact('document'));
    }

    private function searchByType(Request $request, $kodeJenis)
    {
        $request->validate([
            'q' => 'required|string',
        ]);

        $jenis = DocumentType::where('kode', $kodeJenis)->firstOrFail();

        $documents = Document::with(['type', 'progresses.workflow'])
            ->where('jenis_id', $jenis->id)
            ->where('nama_dokumen', 'LIKE', '%' . $request->q . '%')
            ->paginate(10) 
            ->withQueryString(); 

        return view('pages.result', [
            'documents' => $documents,
            'q' => $request->q,
            'jenis' => $jenis->nama,
        ]);
    }
}
