<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MO-AKURAT</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    <!-- ✅ Favicon -->
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

    <section class="position-relative">
        <!-- Background -->
        <img src="{{ asset('assets/img/hero.png') }}" alt="Banner Image" class="img-fluid w-100"
            style="height: 400px; object-fit: cover;">

        <!-- Overlay -->
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.55);"></div>

        <!-- Content -->
        <div class="position-absolute top-50 start-50 translate-middle text-center px-3">
            <h1 class="fw-bold display-5 text-white mb-2">
                MO-AKURAT
            </h1>
            <p class="lead text-white-50 mb-3">
                Monitoring Administrasi Keuangan Terpusat
            </p>
            <span class="badge px-3 py-3" style="background-color:#FCB717; color:#293A6D; font-size:1rem;">
                @yield('title')
            </span>
        </div>
    </section>



    {{-- Main --}}
    @yield('content')

    {{-- Footer --}}
    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
        integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous">
    </script>
</body>

</html>
