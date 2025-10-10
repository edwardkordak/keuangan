@extends('layouts.app')
@section('title', 'Detail Dokumen')
@section('content')

<main class="container my-5 flex-grow-1">

    <div class="card shadow-lg rounded-4 border-0">
        <div class="card-header text-white fw-bold"
             style="background: linear-gradient(90deg,#293A6D,#1f2c50);">
            Detail Dokumen
        </div>
        <div class="card-body">
            <h4 class="mb-3 fw-bold" style="color:#293A6D;">
                {{ $document->nama_dokumen }}
            </h4>
            <p><strong>Jenis:</strong>
                <span class="badge px-3 py-2"
                      style="background-color:#FCB717; color:#293A6D;">
                    {{ $document->type->nama }}
                </span>
            </p>
            <p><strong>Tanggal Diterima:</strong> {{ $document->tanggal_diterima }}</p>

            <!-- Progress Bar -->
            @php
                $total = $document->progresses->count();
                $done = $document->progresses->where('is_checked', true)->count();
                $percent = $total > 0 ? round(($done / $total) * 100) : 0;
            @endphp
            <div class="mb-4">
                <label class="fw-semibold mb-1">Progress</label>
                <div class="progress rounded-pill" style="height: 25px; background:#e9ecef;">
                    <div class="progress-bar fw-bold"
                         role="progressbar"
                         style="width: {{ $percent }}%;
                                background-color: {{ $percent == 100 ? '#293A6D' : '#FCB717' }};">
                        {{ $percent }}%
                    </div>
                </div>
            </div>

            <!-- Timeline -->
            <h5 class="mb-3 fw-bold" style="color:#293A6D;">Alur Proses</h5>
            <ul class="list-group list-group-flush">
                @foreach ($document->progresses as $pg)
                    <li class="list-group-item d-flex align-items-center timeline-item">
                        @if ($pg->is_checked)
                            <i class="bi bi-check-circle-fill me-3"
                               style="font-size: 1.5rem; color:#293A6D;"></i>
                        @else
                            <i class="bi bi-circle me-3"
                               style="font-size: 1.5rem; color:#FCB717;"></i>
                        @endif

                        <div>
                            <strong>{{ $pg->workflow->step_name }}</strong><br>
                            <small class="text-muted">
                                @if ($pg->checked_at)
                                    ✅ Selesai pada {{ $pg->checked_at->format('d M Y H:i') }}
                                @else
                                    ⏳ Belum selesai
                                @endif
                            </small>
                            <p>{{ $pg->workflow->step_description }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <a href="{{ url()->previous() }}"
       class="btn mt-3 fw-semibold d-inline-flex align-items-center gap-2"
       style="background-color:#293A6D; color:white; border-radius:8px; transition:0.3s;">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

</main>

{{-- Custom CSS --}}
<style>
.timeline-item:hover {
    background-color: #f9fafc;
    transition: background 0.3s ease;
}
.btn:hover {
    transform: translateY(-2px);
    opacity: 0.9;
}
</style>
@endsection
