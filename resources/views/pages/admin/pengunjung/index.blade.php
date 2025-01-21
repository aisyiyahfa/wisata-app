@extends('layouts.template')

@section('title')
Role
@endsection
@section('sub-title')
Role Data
@endsection



@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="text-center">Data Roles</h4>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-outline-primary px-4 shadow" style="border-radius: 25px;" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add
            </button>
            <div class="table-responsive">
                <table id="example1" class="table table-borderless table-striped ">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        @foreach ($roles as $item )
                        <tr class="text-center">
                            <td>{{ $no++ }}</td>
                            <td>{{$item->nama_roles}}</td>
                            <td>
                                <div class="btn-group ">
                                    <button class="btn btn-sm btn-warning mr-1" data-toggle="modal" data-target="#edit{{$item->id}}"><i class="fa fa-pencil-alt" aria-hidden="true"></i></button>
                                    <form action="{{route('roles.destroy', $item->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </div>
                                </form>
                            </td>
                        </tr>


                        <div class="modal fade" id="edit{{$item->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add Role</h4>
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

                                        <form action="{{route('roles.update', $item->id)}}" method="Post">
                                            @csrf
                                            @method('put')
                                            <div class="form-group">
                                                <label for="role">Role</label>
                                                <input type="text" class="form-control" name="nama_roles" value="{{$item->nama_roles}}" id="role" placeholder="Nama Role" required>
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
                <h4 class="modal-title">Add Role</h4>
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

                <form action="{{route('roles.store')}}" method="Post">
                    @csrf
                    <div class="form-group">
                        <label for="role">Role</label>
                        <input type="text" class="form-control" name="nama_roles" id="role" placeholder="Nama Role" required>
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
