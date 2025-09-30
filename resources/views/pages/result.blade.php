@extends('layouts.app')
@section('title', 'Hasil Tracking')
@section('content')

    <main class="container my-5 flex-grow-1">

<h4 class="fw-bold mb-4" style="color:#293A6D;">
    Hasil Pencarian
</h4>
<div class="p-3 rounded-3 shadow-sm mb-4" 
     style="background-color:#f9fafc; border-left:6px solid #FCB717;">
    <span class="me-2">Kata kunci:</span>
    <span class="fw-bold" style="color:#293A6D;">"{{ $q }}"</span>
    <span class="ms-2">| Jenis:</span>
    <span class="fw-bold" style="color:#FCB717;">{{ $jenis }}</span>
</div>


        @if ($documents->isNotEmpty())
            <div class="card" style="border-radius: 12px;">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle text-center mb-0">
                            <thead style="background: linear-gradient(90deg,#293A6D,#1f2c50); color:white;">
                                <tr>
                                    <th class="py-3">No</th>
                                    <th>Dokumen</th>
                                    {{-- <th>Jenis</th> --}}
                                    <th>Tanggal Diterima</th>
                                    <th>Progress</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($documents as $i => $doc)
                                    @php
                                        $total = $doc->progresses->count();
                                        $done = $doc->progresses->where('is_checked', true)->count();
                                        $percent = $total > 0 ? round(($done / $total) * 100) : 0;
                                    @endphp
                                    <tr class="table-row-hover">
                                        <td class="fw-bold text-secondary">{{ $i + 1 }}</td>
                                        <td class="fw-semibold">{{ $doc->nama_dokumen }}</td>
                                        {{-- <td>
                                            <span class="badge px-3 py-2"
                                                style="background-color:#FCB717; color:#293A6D; font-size:0.9rem;">
                                                {{ $doc->type->nama }}
                                            </span>
                                        </td> --}}
                                        <td>{{ $doc->tanggal_diterima }}</td>
                                        <td>
                                            <div class="progress rounded-pill" style="height: 22px; background:#e9ecef;">
                                                <div class="progress-bar fw-bold text-dark"
                                                    style="width: {{ $percent }}%;
                                                        background-color: {{ $percent == 100 ? '#293A6D' : '#FCB717' }};">
                                                    {{ $percent }}%
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('documents.show', $doc->id) }}"
                                                class="btn btn-sm px-3 fw-semibold d-flex align-items-center gap-1"
                                                style="background-color:#293A6D; color:white; border-radius:8px; transition:0.3s;">
                                                <i class="bi bi-search"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <div class="alert text-center fw-semibold shadow-sm rounded-3"
                style="background-color:#FCB717; color:#293A6D; border:none;">
                Tidak ditemukan dokumen dengan kata kunci
                <strong>"{{ $q }}"</strong> pada jenis <strong>{{ $jenis }}</strong>.
            </div>
        @endif
                   <div class="mt-3">
                                {{ $documents->links() }}
                            </div>
    </main>

    {{-- Custom Styling --}}
    <style>
        .table-row-hover:hover {
            background-color: #f9fafc !important;
            transition: background 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            opacity: 0.9;
        }
    </style>
@endsection
