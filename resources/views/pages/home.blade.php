<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MO-AKURAT | Monitoring Administrasi Keuangan Terpusat</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/logo.svg') }}">
</head>

<body class="d-flex flex-column min-vh-100">

    {{-- Header --}}
    <header class="py-3" style="background-color: #293A6D;">
        <div class="container d-flex justify-content-between align-items-center text-white">
            <div class="d-flex align-items-center gap-2">
                <a href="/" style="text-decoration: none; color: aliceblue;">
                    <img src="{{ asset('assets/img/logo.svg') }}" alt="Logo" style="height:36px;">
                    <span class="fw-bold">MO-AKURAT</span>
                </a>
            </div>
            <a href="{{ route('login') }}" class="btn btn-warning fw-semibold">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </a>
        </div>
    </header>

    {{-- Hero Section --}}
    <section class="position-relative">
        <img src="{{ asset('assets/img/hero.png') }}" class="img-fluid w-100" style="height: 400px; object-fit: cover;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.55);"></div>

        <div class="position-absolute top-50 start-50 translate-middle text-center text-white">
            <h1 class="display-5 fw-bold">MO-AKURAT</h1>
            <p class="lead">Monitoring Administrasi Keuangan Terpusat</p>
            <a href="{{ route('gup') }}" class="btn btn-lg fw-semibold mt-3" style="background-color: #FCB717; color: #293A6D;">
                <i class="bi bi-search"></i> Mulai Cari
            </a>
        </div>
    </section>

    {{-- Features --}}
    <section class="container my-5 text-center">
        <h2 class="fw-bold mb-4" style="color:#293A6D;">Kenapa MO-AKURAT?</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <i class="bi bi-speedometer2 display-4 text-warning"></i>
                <h5 class="mt-3">Cepat</h5>
                <p>Pencarian dokumen keuangan yang akurat dan instan.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-shield-lock-fill display-4 text-warning"></i>
                <h5 class="mt-3">Aman</h5>
                <p>Data tersimpan dengan keamanan yang terjamin.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-diagram-3-fill display-4 text-warning"></i>
                <h5 class="mt-3">Terintegrasi</h5>
                <p>Monitoring terpusat untuk semua jenis dokumen.</p>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="mt-auto text-white py-3" style="background-color: #293A6D;">
        <div class="container text-center">
            <small>&copy; 2025 MO-AKURAT. All rights reserved.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
