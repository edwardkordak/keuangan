@extends('layouts.auth')
@section('content')
    <div class="login-card text-center" style="background-color: #F7F7F7">
        <!-- Logo -->
        <div class="mb-3">
            <a href="/">

                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" style="width: auto; height: 40px;">
            </a>
        </div>

        <!-- Judul -->
        <h4 class="fw-bold mb-3">Login ke MO-AKURAT</h4>
        <p class="text-muted">Silakan masukkan email dan password Anda</p>

        <!-- Form Login -->
        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-3 text-start">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email"
                    required>
            </div>

            <div class="mb-3 text-start">
                <label for="password" class="form-label fw-semibold">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Masukkan password" required>
                    <span class="input-group-text">
                        <i class="bi bi-eye" id="togglePassword" style="cursor:pointer;"></i>
                    </span>
                </div>
            </div>
            <button type="submit" class="btn btn-custom w-100 py-2">
                <i class="bi bi-box-arrow-in-right me-1"></i> Login
            </button>
        </form>

        <hr class="my-4">

    </div>
@endsection
