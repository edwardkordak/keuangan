@extends('layouts.backend')
@section('title', 'Update Progress')
@section('content')

    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Update Progress</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('progress.index') }}">Progress</a></li>
                                <li class="breadcrumb-item">Update</li>
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
                            <h5>Update Progress Dokumen</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('progress.update', $progress->id) }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label>Dokumen</label>
                                    <input type="text" class="form-control"
                                        value="{{ $progress->document->nama_dokumen ?? '-' }}" disabled>
                                </div>

                                <div class="form-group">
                                    <label>Step</label>
                                    <input type="text" class="form-control"
                                        value="{{ $progress->workflow->step_name ?? '-' }}" disabled>
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="is_checked" id="is_checked"
                                        {{ $progress->is_checked ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_checked">
                                        Tandai Selesai
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <textarea name="description" id="description" rows="3"
                                        class="form-control @error('description') is-invalid @enderror">{{ old('description', $progress->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                @if ($progress->checked_at)
                                    <p><strong>Sudah dicentang pada:</strong>
                                        {{ $progress->checked_at->format('d-m-Y H:i') }}</p>
                                @endif

                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('progress.index') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
@endsection
