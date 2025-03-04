@extends('layouts.template')

@section('content')
<div class="container">
    <h4 class="text-center">Grafik Jumlah Pengunjung Per Bulan</h4>
    
    <!-- Form Filter Tahun -->
    <form action="{{ route('jumlah-pengunjung.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="number" name="tahun" value="{{ request('tahun') ?? date('Y') }}" class="form-control">
            </div>
        </div>
    </form>

    <canvas id="pengunjungChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('pengunjungChart').getContext('2d');
    var pengunjungChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels), 
            datasets: [{
                label: 'Jumlah Pengunjung Tahun {{ $tahun }}',
                data: @json($values),
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
