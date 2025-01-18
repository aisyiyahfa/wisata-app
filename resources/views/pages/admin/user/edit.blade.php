@extends('layouts.template')


@section('title')
User
@endsection
@section('sub-title')
Edit User
@endsection


@section('content')
<div class="col-md-1"></div>

<div class="col-md-10">
    <div class="card">
        <div class="card-header bg-primary">
            <h4 class="text-center">Edit User</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{route('user.update', $user->id)}}" method="Post">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" value="{{$user->name}}" id="name" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" value="{{$user->email}}" id="email" placeholder="Email" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role_id" id="role" class="form-control select2" required>
                                <option value="{{$user->role_id}}">{{$user->role->nama_roles}}</option>
                                @foreach ($roles as $item)
                                <option value="{{$item->id}}">{{$item->nama_roles}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">  
                        <div class="form-group">  
                            <label for="jabatan">Jabatan</label>  
                            <select name="jabatan_id" id="jabatan" class="form-control select2" required>  
                                <option value="{{ $user->jabatan ? $user->jabatan->jabatan_id : '' }}">  
                                    {{ $user->jabatan ? $user->jabatan->nama_jabatan : 'Pilih Jabatan' }}  
                                </option>  
                                @foreach ($jabatan as $item)  
                                    <option value="{{ $item->id }}">  
                                        {{ $item->nama_jabatan }}  
                                    </option>  
                                @endforeach  
                            </select>  
                        </div>  
                    </div>                      
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <small class="text-red">Kosong kan jika tidak ingin menganti password!</small>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" require>
                </div>
                <a href="{{route('user.index')}}" type="submit" class="btn btn-outline-primary">Cancel</a>
                <button type="submit" class="btn btn-primary px-5">Save</button>
            </form>
        </div>
    </div>

</div>

<div class="col-md-1"></div>
@endsection
