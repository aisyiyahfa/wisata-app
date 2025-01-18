@extends('layouts.template')


@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="text-center">Data Jabatan</h4>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-outline-primary px-4 shadow" style="border-radius: 25px;" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add
            </button>
            <div class="table-responsive">
                <table id="example1" class="table table-borderless table-stripped">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Jabatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        @foreach ($jabatan as $item )

                        <tr class="text-center">
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->nama_jabatan }}</td>
                            <td>
                                <div class="btn-group">
                                    <buttom class="btn btn-warning mr-1" data-toggle="modal" data-target="#edit{{$item->id}}"><i class="fa fa-pencil-alt" aria-hidden="true"></i></buttom>
                                    <form action="{{ route('jabatan.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                            </td>
                        </tr>


                        <div class="modal fade" id="edit{{$item->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add Jabatan</h4>
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

                                        <form action="{{route('jabatan.update', $item->id)}}" method="Post">
                                            @csrf
                                            @method('put')
                                            <div class="form-group">
                                                <label for="jabatan">jabatan</label>
                                                <input type="text" class="form-control" name="nama_jabatan" value="{{$item->nama_jabatan}}" id="jabatan" placeholder="Nama jabatan" required>
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
                <h4 class="modal-title">Add Jabatan</h4>
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

                <form action="{{route('jabatan.store')}}" method="Post">
                    @csrf
                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <input type="text" class="form-control" name="nama_jabatan" id="jabatan" placeholder="Nama Jabatan" required>
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
