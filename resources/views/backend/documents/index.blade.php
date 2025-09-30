@extends('layouts.backend')
@section('title', 'Dokumen')
@section('content')

    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Dokumen</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item text-white">Dokumen</li>
                                <li class="breadcrumb-item text-white">Tabel</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Data Dokumen</h5>
                            <a href="{{ route('documents.create') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus-lg"></i> Tambah
                            </a>
                        </div>

                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-striped align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Nama Dokumen</th>
                                            <th>Jenis</th>
                                            <th>Tanggal Diterima</th>
                                            <th>Progress</th>
                                            <th>File</th>
                                            <th style="width: 120px;">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($documents as $doc)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $doc->nama }}</td>
                                                <td>{{ $doc->nama_dokumen }}</td>
                                                <td>{{ $doc->type->nama ?? '-' }}</td>
                                        
                                                <td>{{ $doc->tanggal_diterima }}</td>
                                                        <td>
                                                    @php
                                                        $total = $doc->progresses->count();
                                                        $done = $doc->progresses->where('is_checked', true)->count();
                                                        $percent = $total > 0 ? round(($done / $total) * 100) : 0;
                                                    @endphp
                                                    <div class="progress" style="height:20px;">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            style="width: {{ $percent }}%;"
                                                            aria-valuenow="{{ $percent }}" aria-valuemin="0"
                                                            aria-valuemax="100">
                                                            {{ $percent }}%
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($doc->file_path)
                                                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank"
                                                            class="btn btn-sm btn-info">
                                                            <i class="bi bi-file-earmark"></i> Lihat
                                                        </a>
                                                    @else
                                                        <span class="text-muted">Tidak ada</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('progress.show', $doc->id) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="bi bi-list-check"></i> Progress
                                                    </a>
                                                    <a href="{{ route('documents.edit', $doc->id) }}"
                                                        class="btn btn-sm btn-warning" title="Edit">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <form action="{{ route('documents.destroy', $doc->id) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Yakin hapus dokumen ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                            <i class="bi bi-x-lg"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">
                                                    Belum ada dokumen.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
                            <div class="mt-3">
                                {{ $documents->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
@endsection
