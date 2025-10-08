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
                        <h6 class="text-muted">Sudah SP2D</h6>
                        <h2 class="fw-bold">{{ $completedDocuments }}</h2>
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
                        <h6 class="text-muted">Belum SP2D</h6>
                        <h2 class="fw-bold">{{ $unfinishedDocuments }}</h2>
                    </div>
                </div>
            </div>

            <!-- Row: Chart & Dokumen terbaru -->
            <div class="row">
                <div class="col-md-8 mb-4">
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-header bg-light fw-bold d-flex justify-content-between align-items-center">
                            <span>Progress per Step</span>
                            <select id="docTypeSelect" class="form-select form-select-sm w-auto">
                                <option value="">-- Pilih Jenis Dokumen --</option>
                                @foreach ($documentsByType as $type)
                                    <option value="{{ $type->id }}" {{ $type->id == 1 ? 'selected' : '' }}>
                                        {{ $type->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="card-body">
                            <canvas id="docBarChart" height="150"></canvas>
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
        let ctx = document.getElementById('docBarChart');
        let chart;

        // === FUNGSI PEMUAT DATA ===
        function loadChartData(typeId) {
            if (!typeId) return;

            fetch(`{{ route('dashboard.chartData') }}?type_id=${typeId}`)
                .then(res => res.json())
                .then(data => {
                    const labels = data.map(d => d.step);
                    const counts = data.map(d => d.count);

                    if (chart) chart.destroy();

                    chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Jumlah Dokumen per Step',
                                data: counts,
                                backgroundColor: '#4e73df',
                                borderRadius: 8
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            return `${context.parsed.y} dokumen`;
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Jumlah Dokumen'
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Tahapan (Step)'
                                    }
                                }
                            }
                        }
                    });
                })
                .catch(err => console.error('Error loading chart:', err));
        }

        // === EVENT DROPDOWN ===
        document.getElementById('docTypeSelect').addEventListener('change', function() {
            loadChartData(this.value);
        });

        // === LOAD DEFAULT DATA (document_type_id = 1) ===
        document.addEventListener('DOMContentLoaded', function() {
            const defaultType = 1; // SPK
            loadChartData(defaultType);
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
