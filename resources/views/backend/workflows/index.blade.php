@extends('layouts.backend')
@section('title', 'Workflow Step')
@section('content')

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Workflow Step</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item text-white">Workflow</li>
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
                        <h5 class="mb-0">Data Workflow Step</h5>
                        <a href="{{ route('workflows.create') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus-lg"></i> Tambah
                        </a>
                    </div>

                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-striped align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Dokumen</th>
                                        <th>Step</th>
                                        <th>Nama Step</th>
                                        <th>Deskripsi</th>
                                        <th style="width: 120px;">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($workflows as $wf)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $wf->type->nama ?? '-' }}</td>
                                            <td>{{ $wf->step_number }}</td>
                                            <td>{{ $wf->step_name }}</td>
                                            <td>{{ Str::limit($wf->step_description, 30) }}</td>
                                            <td>
                                                <a href="{{ route('workflows.edit', $wf->id) }}"
                                                   class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <form action="{{ route('workflows.destroy', $wf->id) }}"
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('Yakin hapus step ini?');">
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
                                            <td colspan="6" class="text-center text-muted">
                                                Belum ada workflow step.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        <div class="mt-3">
                            {{-- {{ $workflows->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
@endsection
