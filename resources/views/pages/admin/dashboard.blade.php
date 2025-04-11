@extends('layouts.template')

@section('title')
    Dashboard
@endsection

@section('sub-title')
@endsection

@section('content')
    @if (in_array(Auth::user()->role_id, [1, 2]))
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-3 col-8">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $saldoKeuangan }}</h3>
                            <p> Saldo Keuangan</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-money-bill"></i>
                        </div>
                        <a href="{{ route('laporan.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
    @endif
    @if (in_array(Auth::user()->role_id, [1]))
        <div class="col-lg-3 col-8">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $jumlahUsers }}</h3>
                    <p>Users</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users" aria-hidden="true"></i>
                </div>
                <a href="{{ route('user.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        @endif
        @if (in_array(Auth::user()->role_id, [1,2]))
        <div class="col-lg-3 col-8">
            <!-- small box -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $jumlahPengunjung }}</h3>
                    <p>Jumlah Pengunjung</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user-friends" aria-hidden="true"></i>
                </div>
                <a href="{{ route('jumlah-pengunjung.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        @endif
    @if (in_array(Auth::user()->role_id, [1, 2]))
        <div class="col-lg-3 col-8">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $jumlahSurat }}</h3>
                    <p>Surat Menyurat</p>
                </div>
                <div class="icon">
                    <i class="fas fa-envelope-open"></i>
                </div>
                <a href="{{ route('agenda.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        </div>
        </div>
        @endif

        @if (in_array(Auth::user()->role_id, [1,3]))
        <div class="container">
            <!-- Filter Keuangan -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <form action="{{ route('dashboard') }}" method="GET">
                        <div class="d-flex align-items-center">
                            <input type="hidden" name="tahun_surat" value="{{ request('tahun_surat', date('Y')) }}">
                            <input type="text" class="form-control" name="tahun_keuangan" 
                                value="{{ request('tahun_keuangan', date('Y')) }}" placeholder="Tahun Keuangan">
                            <button type="submit" class="btn btn-primary mx-2">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
    
            <!-- Grafik Keuangan -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">Report Keuangan</h3>
                        </div>
                        <div class="card-body">
                            <div class="chart-container" style="position: relative; height:400px; width:100%">
                                <canvas id="areaChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    @if (in_array(Auth::user()->role_id, [4]))
        <div class="container">
            <!-- Filter Surat Menyurat -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <form action="{{ route('dashboard') }}" method="GET">
                        <div class="d-flex align-items-center">
                            <input type="hidden" name="tahun_keuangan" value="{{ request('tahun_keuangan', date('Y')) }}">
                            <input type="text" class="form-control" name="tahun_surat" 
                                value="{{ request('tahun_surat', date('Y')) }}" placeholder="Tahun Surat">
                            <button type="submit" class="btn btn-primary mx-2">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
    
            <!-- Grafik Surat Menyurat -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Report Surat Menyurat</h3>
                        </div>
                        <div class="card-body">
                            <div class="chart-container" style="position: relative; height:400px; width:100%">
                                <canvas id="suratChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif



    @if (in_array(Auth::user()->role_id, [5]))
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4 class="text-center">Video Wisata Religi Sendang Bagusan & Makam K.H.R. Bagus Khasantuka</h4>
                </div>
                <div class="card-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <a href="https://www.youtube.com/watch?v=MuoxbHtOGWI" target="_blank">
                            <iframe class="embed-responsive-item"
                                src="https://www.youtube.com/embed/MuoxbHtOGWI?autoplay=1&rel=0&modestbranding=1&enablejsapi=1"
                                allowfullscreen></iframe>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Grafik Keuangan
            var canvasArea = document.getElementById("areaChart");
            if (canvasArea) {
                var ctx = canvasArea.getContext("2d");

                var bulanLabels = @json($bulanLabels);
                var dataPemasukan = @json($dataPemasukan) || [];
                var dataPengeluaran = @json($dataPengeluaran) || [];

                console.log("Labels (Bulan):", bulanLabels);
                console.log("Data Pemasukan:", dataPemasukan);
                console.log("Data Pengeluaran:", dataPengeluaran);

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: bulanLabels,
                        datasets: [
                            {
                                label: 'Pemasukan',
                                backgroundColor: 'rgba(60,141,188,0.9)',
                                borderColor: 'rgba(60,141,188,0.8)',
                                data: dataPemasukan,
                                borderWidth: 1
                            },
                            {
                                label: 'Pengeluaran',
                                backgroundColor: 'rgba(255, 99, 132, 0.9)',
                                borderColor: 'rgba(255, 99, 132, 0.9)',
                                data: dataPengeluaran,
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: { grid: { display: false } },
                            y: { beginAtZero: true }
                        }
                    }
                });
            }

            // Grafik Surat Menyurat
            var canvasSurat = document.getElementById("suratChart");
            if (canvasSurat) {
                var ctxSurat = canvasSurat.getContext("2d");

                // Default data surat masuk & keluar per bulan
                var defaultBulan = {
                    "01": 0, "02": 0, "03": 0, "04": 0, "05": 0, "06": 0,
                    "07": 0, "08": 0, "09": 0, "10": 0, "11": 0, "12": 0
                };

                // Ambil data surat dari server
                var dataSuratMasuk = {!! json_encode($dataSuratMasuk->groupBy(function($date) {
                    return \Carbon\Carbon::parse($date->tanggal_surat)->format('m');
                })->map->count()) !!} || {};

                var dataSuratKeluar = {!! json_encode($dataSuratKeluar->groupBy(function($date) {
                    return \Carbon\Carbon::parse($date->tanggal_surat)->format('m');
                })->map->count()) !!} || {};

                // Gabungkan dengan default untuk memastikan semua bulan ada
                dataSuratMasuk = { ...defaultBulan, ...dataSuratMasuk };
                dataSuratKeluar = { ...defaultBulan, ...dataSuratKeluar };


                // Label bulan dalam bahasa Indonesia
                var bulanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

                // Ambil nilai sesuai urutan bulan
                var suratMasukValues = Object.values(dataSuratMasuk).map(Number);
                var suratKeluarValues = Object.values(dataSuratKeluar).map(Number);

                // Debugging data di console
                console.log("Surat Masuk per Bulan:", dataSuratMasuk);
                console.log("Surat Keluar per Bulan:", dataSuratKeluar);

                new Chart(ctxSurat, {
                    type: 'bar',
                    data: {
                        labels: bulanLabels,
                        datasets: [
                            {
                                label: "Surat Masuk",
                                backgroundColor: "rgba(60,141,188,0.9)",
                                borderColor: "rgba(60,141,188,0.8)",
                                data: suratMasukValues
                            },
                            {
                                label: "Surat Keluar",
                                backgroundColor: "rgba(210, 214, 222, 1)",
                                borderColor: "rgba(210, 214, 222, 1)",
                                data: suratKeluarValues
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: { beginAtZero: true }
                        }
                    }
                });
            }
        });
    </script>
@endpush