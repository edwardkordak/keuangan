@extends('layouts.backend')
@section('title', 'Tambah Dokumen')
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
                                <li class="breadcrumb-item text-white"><a href="{{ route('documents.index') }}">Dokumen</a></li>
                                <li class="breadcrumb-item text-white">Tambah</li>
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
                            <h5>Tambah Dokumen</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" id="nama"
                                        class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}"
                                        required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="nama_dokumen">Nama Dokumen</label>
                                    <input type="text" name="nama_dokumen" id="nama_dokumen"
                                        class="form-control @error('nama_dokumen') is-invalid @enderror"
                                        value="{{ old('nama_dokumen') }}" required>
                                    @error('nama_dokumen')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="jenis_id">Jenis Dokumen</label>
                                    <select name="jenis_id" id="jenis_id"
                                        class="form-control @error('jenis_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih Jenis --</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}"
                                                {{ old('jenis_id') == $type->id ? 'selected' : '' }}>
                                                {{ $type->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jenis_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tanggal_diterima">Tanggal Diterima</label>
                                    <input type="date" name="tanggal_diterima" id="tanggal_diterima"
                                        class="form-control @error('tanggal_diterima') is-invalid @enderror"
                                        value="{{ old('tanggal_diterima') }}" required>
                                    @error('tanggal_diterima')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="file_path">File (opsional)</label>
                                    <input type="file" name="file_path" id="file_path"
                                        class="form-control @error('file_path') is-invalid @enderror">
                                    @error('file_path')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="{{ route('documents.index') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
@endsection
