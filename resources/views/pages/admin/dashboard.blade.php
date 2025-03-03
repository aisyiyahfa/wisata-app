@extends('layouts.template')

@section('title')
    Dashboard
@endsection

@section('sub-title')
@endsection

@section('content')
    @if (in_array(Auth::user()->role_id, [1, 2, 3, 4]))
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
    @if (in_array(Auth::user()->role_id, [1, 2]))
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
                <a href="{{ route('reservasi.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    @endif
    @if (in_array(Auth::user()->role_id, [1, 2, 3, 4]))
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

        <div class="row">
            <div class="col-md-4 mb-4">
                <form action="{{ route('dashboard') }}" method="GET">
                    <div class="d-flex align-items-center">
                        <input type="text" class="form-control" name="tahun" value="{{ request('tahun') ?? date('Y') }}">
                        <button type="submit" class="btn btn-primary mx-2">Filter</button>
                    </div>
                </form>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- AREA CHART -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Report Keuangan</h3>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="areaChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
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
        $(function() {
            var ctx = $('#areaChart').get(0).getContext('2d');

            var chartData = {
                labels: @json($bulanLabels),
                datasets: [{
                        label: 'Pemasukan',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        data: @json($dataPemasukan)
                    },
                    {
                        label: 'Pengeluaran',
                        backgroundColor: 'rgba(255, 99, 132, 0.9)',
                        borderColor: 'rgba(255, 99, 132, 0.9)',
                        data: @json($dataPengeluaran)
                    }
                ]
            };

            var chartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        grid: {
                            display: true,
                            drawBorder: false
                        }
                    }
                }
            };

            new Chart(ctx, {
                type: 'bar',
                data: chartData,
                options: chartOptions
            });
        });
    </script>
@endpush
