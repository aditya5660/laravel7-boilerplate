@extends('layouts.admin')
@section('title')
    Edit User
@endsection
@section('content')    
<div class="page-inner">
    @include('layouts.alert')
    <div class="card">
        <form method="POST" action="{{route('admin.users.update',$user)}}">
            @csrf
            @method('PUT')
            <div class="card-header bg-white">
                <div class="h4 text-primary">
                    Edit User
                    <a href="{{route('admin.users.index')}}" class="float-right btn btn-outline-success btn-sm">
                        <span class="btn-label">
                            <i class="las la-angle-left"></i>
                        </span>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Your Name" value="{{$user->name}}" required="">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Your Email" value="{{$user->email}}" required="" >
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                        <label>Role</label>
                        <select name="role[]" id="" multiple class="form-control select2" multiple data-placeholder="Choose Role" data-allow-clear="1">
                            @foreach ($roles as $role)
                            <option value="{{$role->id}}" @if($user->hasRole($role->name)) selected @endif>{{$role->name}}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <small class="text-danger" >
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer text-right bg-white">
                <button class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection