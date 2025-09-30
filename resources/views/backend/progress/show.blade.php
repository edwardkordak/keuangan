@extends('layouts.backend')
@section('title', 'Progress Dokumen')
@section('content')

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <h5 class="m-b-10">Progress: {{ $document->nama_dokumen }}</h5>
            </div>
        </div>

        <div class="card">
            <div class="card-body table-border-style">
                <form action="{{ route('progress.updateMultiple', $document->id) }}" method="POST">
                    @csrf
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Step</th>
                                    <th>Status</th>
                                    <th>Waktu</th>
                                    <th>Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($document->progresses as $pg)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pg->workflow->step_name }}</td>
                                        <td>
                                            <input type="checkbox" name="progress[{{ $pg->id }}][is_checked]" value="1"
                                                {{ $pg->is_checked ? 'checked' : '' }}>
                                        </td>
                                        <td>{{ $pg->checked_at ? $pg->checked_at->format('d-m-Y H:i') : '-' }}</td>
                                        <td>
                                            <input type="text" class="form-control"
                                                name="progress[{{ $pg->id }}][description]"
                                                value="{{ $pg->description }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Simpan Progress</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
