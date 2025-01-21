@extends('layouts.template')  
  
@section('content')  
<div class="col-md-12">  
    <div class="card">  
        <div class="card-header">  
            <h4 class="text-center">Data Donasi</h4>  
        </div>  
        <div class="card-body">  
            <div class="d-flex align-items-center">    
                <!-- Button to Add Donation -->  
                <a href="{{ route('donasi.create') }}" class="btn btn-md btn-primary px-4 shadow" style="border-radius: 25px; margin-left: 10px;">    
                    <i class="fa fa-plus" aria-hidden="true"></i> Tambah Donasi    
                </a>    
                <!-- Button to Print PDF -->    
                <a href="{{ route('donasi-pdf') }}" class="btn btn-md btn-outline-success px-4 shadow" style="border-radius: 25px; margin-left: 10px;">    
                    <i class="fa fa-file-pdf" aria-hidden="true"></i> Cetak PDF    
                </a>    
            </div>      
            <div class="table-responsive mt-3">  
                <table id="example1" class="table table-borderless table-striped">  
                    <thead>  
                        <tr class="text-center">  
                            <th>No</th>  
                            <th>Nama Pengunjung</th>  
                            <th>Nominal</th>  
                            <th>Tanggal</th>  
                            <th>Status</th>  
                            <th>Aksi</th>  
                        </tr>  
                    </thead>  
                    <tbody>  
                        @foreach ($donasi as $index => $item)  
                        <tr class="text-center">  
                            <td>{{ $index + 1 }}</td>  
                            <td>{{ $item->user->name }}</td>  
                            <td>{{ $item->nominal }}</td>  
                            <td>{{ $item->tanggal }}</td>  
                            <td>{{ $item->status }}</td>  
                            <td>  
                                <div class="btn-group">  
                                    <a href="{{ route('donasi.show', $item->id) }}" class="btn btn-md btn-warning">  
                                        <i class="fa fa-eye" aria-hidden="true"></i>  
                                    </a>  
                                    <form action="{{ route('donasi.destroy', $item->id) }}" method="post" style="display:inline;">  
                                        @csrf  
                                        @method('delete')  
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this donation?');">  
                                            <i class="fa fa-trash" aria-hidden="true"></i>  
                                        </button>  
                                    </form>  
                                </div>  
                            </td>  
                        </tr>  
                        @endforeach  
                    </tbody>  
                </table>  
            </div>  
        </div>  
    </div>  
</div>  
@endsection  
