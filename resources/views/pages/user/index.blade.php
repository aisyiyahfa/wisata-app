@extends('layouts.template')      
  
@section('content')      
<div class="container">      
    <div class="card">      
        <div class="card-header text-center">      
            <h4>TAMBAH DONASI</h4>      
        </div>      
        <div class="card-body">      
            <form action="{{ route('donation.store') }}" method="POST" enctype="multipart/form-data">      
                @csrf      
                <div class="form-group">      
                    <label for="name">NAMA:</label>      
                    <input type="text" class="form-control" name="name" placeholder="Masukkan Nama" required>      
                </div>      
                <div class="form-group">      
                    <label for="nominal">Nominal:</label>      
                    <input type="text" class="form-control" name="nominal" placeholder="Rp. 999,00" required>      
                </div>      
                <div class="form-group">      
                    <label for="date">Tanggal:</label>      
                    <input type="date" class="form-control" name="date" required>      
                </div>      
                <div class="form-group">      
                    <label for="description">Keterangan:</label>      
                    <textarea class="form-control" name="description" placeholder="Keterangan..."></textarea>      
                </div>      
                <div class="form-group">      
                    <label for="transfer_proof">Upload Bukti Transfer:</label>      
                    <input type="file" class="form-control" name="transfer_proof" required>      
                </div>      
                <div class="form-group">      
                    <label for="status">Status:</label>      
                    <select class="form-control" name="status" required>      
                        <option value="pending">Pending</option>      
                        <option value="completed">Completed</option>      
                        <option value="canceled">Canceled</option>      
                    </select>      
                </div>      
                <button type="submit" class="btn btn-primary">DONASI</button>      
                <a href="{{ route('donasi.index') }}" class="btn btn-secondary">KELUAR</a>      
            </form>      
        </div>      
    </div>    
  
    <!-- Reporting Table -->      
    <div class="card mt-4">      
        <div class="card-header text-center">      
            <h4>REPORT DONASI</h4>      
        </div>      
        <div class="card-body">      
            <div class="table-responsive">      
                <table class="table table-bordered table-striped">      
                    <thead>      
                        <tr class="text-center">      
                            <th>No</th>      
                            <th>Nama</th>      
                            <th>Nominal</th>      
                            <th>Tanggal</th>      
                            <th>Keterangan</th>      
                            <th>Bukti Transfer</th>      
                            <th>Status</th>      
                            <th>Aksi</th>      
                        </tr>      
                    </thead>      
                    <tbody>      
                        @foreach ($donations as $index => $donation)      
                        <tr class="text-center">      
                            <td>{{ $index + 1 }}</td>      
                            <td>{{ $donation->name }}</td>      
                            <td>{{ number_format($donation->nominal, 2, ',', '.') }}</td>      
                            <td>{{ $donation->date }}</td>      
                            <td>{{ $donation->description }}</td>      
                            <td>      
                                @if($donation->transfer_proof)      
                                    <a href="{{ asset('storage/uploads/transfer_proofs/' . $donation->transfer_proof) }}" target="_blank">Lihat Bukti</a>      
                                @else      
                                    Tidak Ada Bukti      
                                @endif      
                            </td>      
                            <td>{{ $donation->status }}</td>      
                            <td>      
                                <div class="btn-group">      
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal{{ $donation->id }}">Edit</button>      
                                    <form action="{{ route('donation.destroy', $donation->id) }}" method="POST" style="display:inline;">      
                                        @csrf      
                                        @method('DELETE')      
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>      
                                    </form>      
                                </div>      
                            </td>      
                        </tr>      
  
                        <!-- Edit Modal -->  
<div class="modal fade" id="editModal{{ $donation->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">    
    <div class="modal-dialog" role="document">    
        <div class="modal-content">    
            <div class="modal-header">    
                <h5 class="modal-title" id="editModalLabel">Edit Donasi</h5>    
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">    
                    <span aria-hidden="true">&times;</span>    
                </button>    
            </div>    
            <div class="modal-body">    
                <form action="{{ route('donation.update', $donation->id) }}" method="POST" enctype="multipart/form-data">    
                    @csrf    
                    @method('PUT')    
                    <div class="form-group">    
                        <label for="name">NAMA:</label>    
                        <input type="text" class="form-control" name="name" value="{{ $donation->name }}" required>    
                    </div>    
                    <div class="form-group">    
                        <label for="nominal">Nominal:</label>    
                        <input type="text" class="form-control" name="nominal" value="{{ $donation->nominal }}" required>    
                    </div>    
                    <div class="form-group">    
                        <label for="date">Tanggal:</label>    
                        <input type="date" class="form-control" name="date" value="{{ $donation->date }}" required>    
                    </div>    
                    <div class="form-group">    
                        <label for="description">Keterangan:</label>    
                        <textarea class="form-control" name="description">{{ $donation->description }}</textarea>    
                    </div>    
                    <div class="form-group">    
                        <label for="transfer_proof">Upload Bukti Transfer:</label>    
                        <input type="file" class="form-control" name="transfer_proof">    
                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah bukti transfer.</small>    
                    </div>    
                    <div class="form-group">    
                        <label for="status">Status:</label>    
                        <select class="form-control" name="status" required>    
                            <option value="pending" {{ $donation->status == 'pending' ? 'selected' : '' }}>Pending</option>    
                            <option value="completed" {{ $donation->status == 'completed' ? 'selected' : '' }}>Completed</option>    
                            <option value="canceled" {{ $donation->status == 'canceled' ? 'selected' : '' }}>Canceled</option>    
                        </select>    
                    </div>    
                    <button type="submit" class="btn btn-primary">Update</button>    
                </form>    
            </div>    
        </div>    
    </div>    
</div>    
                        </div>      
                        @endforeach      
                    </tbody>      
                </table>      
            </div>      
        </div>      
    </div>      
</div>    
@endsection    
