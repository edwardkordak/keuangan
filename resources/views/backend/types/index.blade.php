@extends('layouts.backend')
@section('title', 'Jenis Dokumen')
@section('content')

    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Jenis Dokumen</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/') }}"><i class="feather icon-home"></i></a>
                                </li>
                                <li class="breadcrumb-item text-white">Jenis Dokumen</li>
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
                            <h5 class="mb-0">Data Jenis Dokumen</h5>
                            <a href="{{ route('types.create') }}" class="btn btn-sm text-white" style="background-color: #FCB91E;">
                                <i class="bi bi-plus-lg text-white"></i> Tambah
                            </a>
                        </div>

                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-striped align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th style="width: 50px;">No</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th style="width: 120px;">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($types as $type)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $type->kode }}</td>
                                                <td>{{ $type->nama }}</td>
                                                <td>
                                                    <a href="{{ route('types.edit', $type->id) }}"
                                                        class="btn btn-sm btn-warning" title="Edit">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <form action="{{ route('types.destroy', $type->id) }}" method="POST"
                                                        class="d-inline"
                                                        onsubmit="return confirm('Yakin hapus jenis ini?');">
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
                                                <td colspan="4" class="text-center text-muted">
                                                    Belum ada jenis dokumen.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
                            <div class="mt-3">
                                {{-- {{ $types->links() }} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
@endsection
