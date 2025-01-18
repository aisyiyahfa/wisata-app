@extends('layouts.template')  
  
@section('title')  
Dashboard  
@endsection  
  
@section('sub-title')  
@endsection  
  
@section('content')  
<style>  
    .embed-responsive {  
        position: relative;  
        display: block;  
        height: 0;  
        padding: 0;  
        overflow: hidden;  
    }  
  
    .embed-responsive-16by9 {  
        padding-bottom: 56.25%; /* 16:9 */  
    }  
  
    .embed-responsive iframe {  
        position: absolute;  
        top: 0;  
        left: 0;  
        width: 100%;  
        height: 100%;  
    }  
</style>  
  
<div class="col-md-12">  
    <div class="row">  
        <div class="col-md-12">  
            <!-- Video YouTube -->  
            <div class="card card-primary">  
                <div class="card-header">  
                    <h3 class="card-title">Video Wisata Religi Sendang Bagusan & Makam K.H.R. Bagus Khasantuka</h3>  
                </div>  
                <div class="card-body">  
                    <div class="embed-responsive embed-responsive-16by9">  
                        <iframe class="embed-responsive-item" src="https://youtu.be/MuoxbHtOGWI?si=pqGZMiUmNSyJLTt_" allowfullscreen></iframe>  
                    </div>  
                </div>  
                <!-- /.card-body -->  
            </div>  
        </div>  
    </div>  
</div>  
@endsection  
  
@push('addon-script')  
<script>  
    // Jika Anda ingin menambahkan script tambahan, Anda bisa melakukannya di sini  
</script>  
@endpush  
