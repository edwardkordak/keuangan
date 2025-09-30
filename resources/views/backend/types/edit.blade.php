@extends('layouts.backend')
@section('title', 'Edit Jenis Dokumen')
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
                                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item text-white"><a href="{{ route('types.index') }}">Jenis Dokumen</a></li>
                                <li class="breadcrumb-item text-white">Edit</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Edit Jenis Dokumen</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('types.update', $type->id) }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="kode">Kode</label>
                                    <input type="text" name="kode" id="kode"
                                        class="form-control @error('kode') is-invalid @enderror"
                                        value="{{ old('kode', $type->kode) }}" required>
                                    @error('kode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="nama">Nama Jenis</label>
                                    <input type="text" name="nama" id="nama"
                                        class="form-control @error('nama') is-invalid @enderror"
                                        value="{{ old('nama', $type->nama) }}" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('types.index') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
@endsection
