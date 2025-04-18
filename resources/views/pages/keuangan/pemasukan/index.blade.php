@extends('layouts.template')


@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="text-center">Data Keuangan Pemasukan</h4>
        </div>
        <div class="card-body">  
            @if(in_array(Auth::user()->role_id, [1,3,4]))
            <div class="d-flex align-items-center">  
                <!-- Tombol Add -->  
                <button class="btn btn-md btn-outline-primary px-4 shadow" style="border-radius: 25px;" data-toggle="modal" data-target="#modal-default">  
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Add  
                </button>  
                @endif
                <!-- Tombol Cetak PDF -->  
                <a href="{{ route('pemasukan-pdf') }}" class="btn btn-md btn-outline-success px-4 shadow" style="border-radius: 25px; margin-left: 10px;">  
                    <i class="fa fa-file-pdf" aria-hidden="true"></i> Cetak PDF  
                </a>  
            </div>              
            <div class="table-responsive">
                <table id="example1" class="table table-borderless table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                            <th>Catatan</th>
                            @if(in_array(Auth::user()->role_id, [1,3,4]))
                            <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($pemasukan as $item)
                        <tr class="text-center">
                            <td>{{$no++}}</td>
                            <td>{{$item->tanggal}}</td>
                            <td>Rp. {{ number_format($item->nominal, 0,',',',')}}</td>
                            <td>{{$item->catatan}}</td>
                            <td>
                                @if(in_array(Auth::user()->role_id, [1,3,4]))
                                <div class="btn-group ">
                                    <button class="btn btn-sm btn-warning mr-1" data-toggle="modal" data-target="#edit{{$item->id}}"><i class="fa fa-pencil-alt" aria-hidden="true"></i></button>
                                    <form action="{{route('pemasukan.destroy', $item->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </div>
                                @endif
                                </form>
                            </td>
                        </tr>

                        <div class="modal fade" id="edit{{$item->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Pemasukan</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif

                                        <form action="{{route('pemasukan.update', $item->id)}}" method="Post">
                                            @csrf
                                            @method('put')
                                            <div class="form-group">
                                                <label for="tanggal">Tanggal</label>
                                                <input type="date" class="form-control" value="{{$item->tanggal}}" name="tanggal" id="tanggal" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nominal" class="mr-2">Nominal</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                    <input type="number" inputmode="numeric" value="{{$item->nominal}}" class="form-control" name="nominal" id="nominal" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="catatan">Catatan</label>
                                                <textarea name="catatan" class="form-control" cols="30" rows="10">{{$item->catatan}}</textarea>
                                            </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Pemasukan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{route('pemasukan.store')}}" method="Post">
                    @csrf
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal" required>
                    </div>
                    <div class="mb-3">
                        <label for="nominal" class="mr-2">Nominal</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                            <input type="number" inputmode="numeric" class="form-control" name="nominal" id="nominal" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="catatan">Catatan</label>
                        <textarea name="catatan" id="" class="form-control" cols="30" rows="10"></textarea>
                    </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection
