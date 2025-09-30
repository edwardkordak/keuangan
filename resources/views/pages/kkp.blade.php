@extends('layouts.app')
@section('title', 'Kartu Kredit Pemerintah')
@section('content')
    <main class="container my-5 flex-grow-1">

        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs justify-content-center mb-4 border-0">

            <li class="nav-item">
                <a class="nav-link fw-semibold px-4 py-2 text-dark" style="transition: 0.3s;" href="{{ route('gup') }}">
                    GUP
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active fw-semibold px-4 py-2"
                    style="background-color: #293A6D; color: #fff; border-radius: 8px 8px 0 0;" href="{{ route('kkp') }}">
                    KKP
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-semibold px-4 py-2 text-dark" style="transition: 0.3s;" href="{{ route('spk') }}">
                    LS dan SPK
                </a>
            </li>
        </ul>

        <!-- Search Box -->
        <div class="d-flex justify-content-center mb-5">
            <form action="{{ route('kkp.search') }}" method="GET"
                class="input-group shadow-sm rounded-pill overflow-hidden" style="max-width: 650px;">
                <input type="text" name="q" class="form-control border-0"
                    placeholder="🔍 Masukkan nama dokumen yang ingin dicari..." value="{{ request('q') }}">
                <button class="btn fw-semibold px-4" style="background-color: #FCB91E; color: #293A6D; border: none;">
                    Cari
                </button>
            </form>
        </div>

        <!-- Illustration Section -->
        <div class="text-center">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <img src="{{ asset('assets/img/KKP.png') }}" alt="Tracking Illustration"
                        class="img-fluid mx-auto d-block" style="max-width: 500px; height: auto;">
                    <p class="mt-3 text-muted">
                        Sistem pencarian dokumen <strong>KKP</strong> memudahkan Anda memonitor proses administrasi dengan
                        cepat dan akurat.
                    </p>
                </div>
            </div>
        </div>
    </main>

    <!-- Extra Styling -->
    <style>
        .nav-tabs .nav-link {
            border: none;
        }

        .nav-tabs .nav-link:hover {
            background-color: #f8f9fa;
            color: #293A6D !important;
        }

        .nav-tabs .nav-link.active {
            border: none;
            border-bottom: 3px solid #FCB91E;
        }

        input::placeholder {
            color: #999 !important;
            font-style: italic;
        }
    </style>

@endsection
