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

        {{-- ====== ALERT MESSAGE ====== --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="feather icon-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="feather icon-alert-triangle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body table-border-style">
                <form action="{{ route('progress.updateMultiple', $document->id) }}" method="POST">
                    @csrf

                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="35%">Step</th>
                                    <th width="10%">Status</th>
                                    <th width="20%">Waktu</th>
                                    <th width="30%">Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $prevChecked = true; // awalnya true agar step pertama aktif
                                @endphp

                                @foreach ($document->progresses as $pg)
                                    @php
                                        // disable checkbox kalau step sebelumnya belum checked
                                        $disabled = !$prevChecked && !$pg->is_checked;
                                        $prevChecked = $pg->is_checked; // update status buat step berikutnya
                                    @endphp

                                    <tr class="{{ $pg->is_checked ? 'table-success' : '' }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pg->workflow->step_name }}</td>
                                        <td>
                                            <input type="checkbox"
                                                name="progress[{{ $pg->id }}][is_checked]"
                                                value="1"
                                                {{ $pg->is_checked ? 'checked' : '' }}
                                                {{ $disabled ? 'disabled' : '' }}>
                                        </td>
                                        <td>{{ $pg->checked_at ? $pg->checked_at->format('d-m-Y H:i') : '-' }}</td>
                                        <td>
                                            <input type="text"
                                                class="form-control"
                                                name="progress[{{ $pg->id }}][description]"
                                                value="{{ $pg->description }}"
                                                placeholder="Tambahkan catatan...">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <button type="submit" class="btn btn-success mt-3">
                        <i class="feather icon-save me-1"></i> Simpan Progress
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
