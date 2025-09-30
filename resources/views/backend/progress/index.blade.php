@extends('layouts.backend')
@section('title', 'Progress Dokumen')
@section('content')

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Progress Dokumen</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item">Progress</li>
                            <li class="breadcrumb-item">Tabel</li>
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
                    <div class="card-header">
                        <h5 class="mb-0">Daftar Progress</h5>
                    </div>

                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-striped align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Dokumen</th>
                                        <th>Jenis</th>
                                        <th>Step</th>
                                        <th>Status</th>
                                        <th>Waktu</th>
                                        <th>Deskripsi</th>
                                        <th style="width: 120px;">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($progress as $pg)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pg->document->nama_dokumen ?? '-' }}</td>
                                            <td>{{ $pg->document->type->nama ?? '-' }}</td>
                                            <td>{{ $pg->workflow->step_name ?? '-' }}</td>
                                            <td>
                                                @if($pg->is_checked)
                                                    <span class="badge bg-success">Selesai</span>
                                                @else
                                                    <span class="badge bg-secondary">Belum</span>
                                                @endif
                                            </td>
                                            <td>{{ $pg->checked_at ? $pg->checked_at->format('d-m-Y H:i') : '-' }}</td>
                                            <td>{{ Str::limit($pg->description, 30) }}</td>
                                            <td>
                                                <a href="{{ route('progress.edit', $pg->id) }}"
                                                   class="btn btn-sm btn-warning" title="Update">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted">
                                                Belum ada progress dokumen.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        <div class="mt-3">
                            {{-- {{ $progress->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
@endsection
