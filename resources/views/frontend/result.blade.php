@extends('layouts.app')
@section('title', 'Hasil Tracking')
@section('content')

    <main class="container my-5 flex-grow-1">
        @if ($document)
            <h4 class="mb-4">Tracking Dokumen: <span class="text-primary">{{ $document->nama_dokumen }}</span></h4>
            <p><strong>Jenis:</strong> {{ $document->type->nama }}</p>
            <p><strong>Tanggal Diterima:</strong> {{ $document->tanggal_diterima }}</p>

            <!-- progress bar -->
            @php
                $total = $document->progresses->count();
                $done = $document->progresses->where('is_checked', true)->count();
                $percent = $total > 0 ? round(($done / $total) * 100) : 0;
            @endphp
            <div class="progress mb-4" style="height:25px;">
                <div class="progress-bar bg-success fw-bold" style="width: {{ $percent }}%;"
                    aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100">
                    {{ $percent }}%
                </div>
            </div>

            <!-- timeline -->
            <ul class="list-group list-group-flush">
                @foreach ($document->progresses as $pg)
                    <li class="list-group-item d-flex align-items-center">
                        @if ($pg->is_checked)
                            <i class="bi bi-check-circle-fill text-success me-3" style="font-size: 1.5rem;"></i>
                        @else
                            <i class="bi bi-circle text-secondary me-3" style="font-size: 1.5rem;"></i>
                        @endif
                        <div>
                            <strong>{{ $pg->workflow->step_name }}</strong><br>
                            <small class="text-muted">
                                @if ($pg->checked_at)
                                    Selesai pada {{ $pg->checked_at->format('d M Y H:i') }}
                                @else
                                    Belum selesai
                                @endif
                            </small>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="alert alert-warning text-center">
                Dokumen dengan kata kunci <strong>{{ $q }}</strong> tidak ditemukan pada jenis
                {{ $jenis ?? '-' }}.
            </div>
        @endif
    </main>
@endsection
