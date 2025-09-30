@extends('layouts.backend')
@section('title', 'Dashboard')
@section('content')

    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Dashboard</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Pages</a></li>
                                <li class="breadcrumb-item"><a href="#!">Dashboard</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <!-- support-section start -->
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                                <div class="card-body text-center p-4">

                                    <!-- Ikon -->
                                    <div class="mb-3">
                                        <span class="custom-icon">
                                            <i class="feather icon-file-text"></i>
                                        </span>
                                    </div>

                                    <!-- Judul -->
                                    <h6 class="text-uppercase fw-bold text-muted mb-1">Jumlah Document</h6>

                                    <!-- Angka -->
                                    <h2 class="fw-bolder display-5 text-dark">{{ $totalDocument }}</h2>

                                    <!-- Deskripsi -->
                                    <p class="text-muted mt-2 mb-0">
                                        Total keseluruhan document yang telah diterbitkan
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                                <div class="card-body text-center p-4">

                                    <!-- Ikon -->
                                    <div class="mb-3">
                                        <span class="custom-icon">
                                            <i class="feather icon-message-circle"></i>

                                        </span>
                                    </div>

                                    <!-- Judul -->
                                    <h6 class="text-uppercase fw-bold text-muted mb-1">Jenis Dokumen</h6>

                                    <!-- Angka -->
                                    <h2 class="fw-bolder display-5 text-dark">{{ $totalDocumentType }}</h2>

                                    <!-- Deskripsi -->
                                    <p class="text-muted mt-2 mb-0">
                                        Total jenis dokumen yang ada
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                                <div class="card-body text-center p-4">

                                    <!-- Ikon -->
                                    <div class="mb-3">
                                        <span class="custom-icon">
                                            <i class="feather icon-users"></i>

                                        </span>
                                    </div>

                                    <!-- Judul -->
                                    <h6 class="text-uppercase fw-bold text-muted mb-1">Jumlah Apa kek</h6>

                                    <!-- Angka -->
                                    <h2 class="fw-bolder display-5 text-dark">2</h2>

                                    <!-- Deskripsi -->
                                    <p class="text-muted mt-2 mb-0">
                                        Total keseluruhan apa kek ada dalam sistem
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- support-section end -->
                </div>
                <!-- Latest Customers end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <style>
        .custom-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6f42c1, #4facfe);
            color: #fff;
            font-size: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }
    </style>
@endsection
