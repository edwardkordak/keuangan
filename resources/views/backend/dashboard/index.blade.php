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
                                <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item text-white">Dashboard</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Cards Ringkasan ] -->
            <div class="row">
                <!-- Total Dokumen -->
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm rounded-4 text-center p-3">
                        <div class="d-flex justify-content-center mb-2">
                            <span class="custom-icon">
                                <i class="feather icon-file-text"></i>
                            </span>
                        </div>
                        <h6 class="text-muted">Total Dokumen</h6>
                        <h2 class="fw-bold">{{ $totalDocument }}</h2>
                    </div>
                </div>
                <!-- Jenis Dokumen -->
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm rounded-4 text-center p-3">
                        <div class="d-flex justify-content-center mb-2">
                            <span class="custom-icon">
                                <i class="feather icon-layers"></i>
                            </span>
                        </div>
                        <h6 class="text-muted">Jenis Dokumen</h6>
                        <h2 class="fw-bold">{{ $totalDocumentType }}</h2>
                    </div>
                </div>
                <!-- Progress Selesai -->
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm rounded-4 text-center p-3">
                        <div class="d-flex justify-content-center mb-2">
                            <span class="custom-icon">
                                <i class="feather icon-check-circle"></i>
                            </span>
                        </div>
                        <h6 class="text-muted">Progress Selesai</h6>
                        <h2 class="fw-bold">{{ $progressPercentage }}%</h2>
                    </div>
                </div>
                <!-- Dokumen Belum Selesai -->
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm rounded-4 text-center p-3">
                        <div class="d-flex justify-content-center mb-2">
                            <span class="custom-icon">
                                <i class="feather icon-alert-triangle"></i>
                            </span>
                        </div>
                        <h6 class="text-muted">Belum Ada Progress</h6>
                        <h2 class="fw-bold">{{ $unfinishedDocuments }}</h2>
                    </div>
                </div>
            </div>

            <!-- Row: Chart & Dokumen terbaru -->
            <div class="row">
                <div class="col-md-8 mb-4">
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-header bg-light fw-bold">Dokumen per Jenis</div>
                        <div class="card-body">
                            <canvas id="docBarChart" height="130"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-header bg-light fw-bold">Dokumen Terbaru</div>
                        <ul class="list-group list-group-flush">
                            @forelse ($latestDocuments as $doc)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>
                                        <i class="feather icon-file text-primary me-2"></i>
                                        {{ $doc->nama_dokumen }}
                                        <br>
                                        <small class="text-muted">{{ $doc->type->nama ?? '-' }}</small>
                                    </span>
                                    <span class="badge bg-info">{{ $doc->tanggal_diterima }}</span>
                                </li>
                            @empty
                                <li class="list-group-item text-muted">Belum ada dokumen</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Row: Statistik Tambahan -->
            <div class="row">
                <!-- Top Jenis Dokumen -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-header bg-light fw-bold">Top Jenis Dokumen</div>
                        <ul class="list-group list-group-flush">
                            @forelse ($topDocumentTypes as $type)
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>{{ $type->nama }}</span>
                                    <span class="badge bg-primary">{{ $type->documents_count }}</span>
                                </li>
                            @empty
                                <li class="list-group-item text-muted">Belum ada data</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <!-- Top Dokumen -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-header bg-light fw-bold">Dokumen dengan Progress Terbanyak</div>
                        <ul class="list-group list-group-flush">
                            @forelse ($topDocuments as $doc)
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>{{ $doc->nama_dokumen }}</span>
                                    <span class="badge bg-success">{{ $doc->checked_count }} Step</span>
                                </li>
                            @empty
                                <li class="list-group-item text-muted">Belum ada data</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <!-- Aktivitas Terbaru -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-header bg-light fw-bold">Aktivitas Terbaru</div>
                        <ul class="list-group list-group-flush">
                            @forelse ($recentActivities as $act)
                                <li class="list-group-item">
                                    <strong>{{ $act->document->nama_dokumen }}</strong><br>
                                    <small class="text-muted">
                                        {{ $act->document->type->nama ?? '-' }} |
                                        oleh {{ $act->checkedBy->name ?? 'System' }}
                                        pada {{ $act->checked_at?->format('d M Y H:i') }}
                                    </small>
                                </li>
                            @empty
                                <li class="list-group-item text-muted">Belum ada aktivitas</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- CDN Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        new Chart(document.getElementById('docBarChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($documentsByType->pluck('nama')) !!},
                datasets: [{
                    label: 'Jumlah Dokumen',
                    data: {!! json_encode($documentsByType->pluck('documents_count')) !!},
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b'],
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>

    <style>
        .custom-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 55px;
            height: 55px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6f42c1, #4facfe);
            color: #fff;
            font-size: 1.4rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .15);
        }
    </style>
@endsection
