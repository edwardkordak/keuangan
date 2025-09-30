<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentType;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $totalDocument = Document::count();
        $totalDocumentType = DocumentType::count();

        return view('backend.dashboard.index', compact('totalDocument', 'totalDocumentType'));
    }
}
