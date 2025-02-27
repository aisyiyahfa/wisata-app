@extends('layouts.template')

@section('title')
Dashboard
@endsection

@section('sub-title')
@endsection


@section('content')
@if(in_array(Auth::user()->role_id, [1, 2,3,4]))
<div class="col-md-12">
    <div class="row">
        <div class="col-lg-3 col-8">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>150</h3>
                    <p>Keuangan</p>
                </div>
                <div class="icon">
                    <i class="fa fa-money-bill"></i>
                </div>
                <a href="{{ route('pemasukan.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        @endif 
        @if(in_array(Auth::user()->role_id, [1, 2,])) 
        <div class="col-lg-3 col-8">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>150</h3>
                    <p>Users</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users" aria-hidden="true"></i>
                </div>
                <a href="{{ route('user.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-8">
            <!-- small box -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>150</h3>
                    <p>Jumlah Pengunjung</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users" aria-hidden="true"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        @endif
        @if(in_array(Auth::user()->role_id, [1, 2,3,4]))
        <div class="col-lg-3 col-8">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>150</h3>
                    <p>Laporan Donasi</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-money-bill-transfer  nav-icon"></i>
                </div>
                <a href="{{ route('donation.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <!-- AREA CHART -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Report Keuangan</h3>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    
                </div>
                </div>  
            </div>
        </div>
    </div>
</div>
@endif


@if(in_array(Auth::user()->role_id, [5])) 

    <div class="col-md-12">
        <div class="card card-primary">  
            <div class="card-header">  
                <h4 class="text-center">Video Wisata Religi Sendang Bagusan & Makam K.H.R. Bagus Khasantuka</h4>  
            </div>  
            <div class="card-body">  
                <div class="embed-responsive embed-responsive-16by9">  
                    <a href="https://www.youtube.com/watch?v=MuoxbHtOGWI" target="_blank">  
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/MuoxbHtOGWI?autoplay=1&rel=0&modestbranding=1&enablejsapi=1" allowfullscreen></iframe>  
                    </a>   
        </div>
        </div>  
    </div>  
</div>   
@endif    
@endsection

@push('addon-script')
<script>
    $(function() {
        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */

        //--------------
        //- AREA CHART -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

        var areaChartData = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                    label: 'Digital Goods',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: [28, 48, 40, 19, 86, 27, 90]
                },
                {
                    label: 'Electronics',
                    backgroundColor: 'rgba(210, 214, 222, 1)',
                    borderColor: 'rgba(210, 214, 222, 1)',
                    pointRadius: false,
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: [65, 59, 80, 81, 56, 55, 40]
                },
            ]
        }
        var areaChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false,
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false,
                    }
                }]
            }
        }
        new Chart(areaChartCanvas, {
            type: 'line',
            data: areaChartData,
            options: areaChartOptions
        })
    })
</script>
@endpush
