@extends('layouts.backend')
@section('title', 'Tambah Workflow Step')
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
                                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item text-white"><a href="{{ route('workflows.index') }}">Workflow</a></li>
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
                            <h5>Tambah Workflow Step</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('workflows.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="document_type_id">Jenis Dokumen</label>
                                    <select name="document_type_id" id="document_type_id"
                                        class="form-control @error('document_type_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih Jenis --</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}"
                                                {{ old('document_type_id') == $type->id ? 'selected' : '' }}>
                                                {{ $type->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('document_type_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="step_number">Nomor Step</label>
                                    <input type="number" name="step_number" id="step_number"
                                        class="form-control @error('step_number') is-invalid @enderror"
                                        value="{{ old('step_number') }}" required>
                                    @error('step_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="step_name">Nama Step</label>
                                    <input type="text" name="step_name" id="step_name"
                                        class="form-control @error('step_name') is-invalid @enderror"
                                        value="{{ old('step_name') }}" required>
                                    @error('step_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="step_description">Deskripsi Step</label>
                                    <textarea name="step_description" id="step_description" rows="3"
                                        class="form-control @error('step_description') is-invalid @enderror">{{ old('step_description') }}</textarea>
                                    @error('step_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="{{ route('workflows.index') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
@endsection
