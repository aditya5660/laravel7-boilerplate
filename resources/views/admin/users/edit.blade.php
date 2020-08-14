@extends('layouts.admin')
@section('title')
    Create User
@endsection
@section('content')    
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title ">User Management</h4>
        <ul class="breadcrumbs d-none d-md-block">
            <li class="nav-home">
                <a href="{{route('admin.dashboard')}}">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Administrator</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.users.index')}}">User</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item text-primary">
                Edit
            </li>
        </ul>
    </div>
    @include('layouts.alert')
    <div class="card">
        <form method="POST" action="{{route('admin.users.update',$user)}}" id="form">
            @csrf
            @method('PUT')
            <div class="card-header d-flex d-justify-content-between">
                <div class="card-title font-weight-bold">Edit User</div>
                <div class="ml-auto">
                    <a href="{{route('admin.users.index')}}" class="btn btn-default btn-sm shadow">
                        <span class="btn-label">
                            <i class="fa fa-angle-left"></i>
                        </span>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group ">
                            <label>Name*</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Your Name" value="{{$user->name}}" required="">
                            <label for="name" class="error form-text text-danger"> @error('name') {{ $message }} @enderror</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group ">
                            <label>Email*</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Your Email" value="{{$user->email}}" required="" >
                            <label for="email" class="error form-text text-danger"> @error('email') {{ $message }} @enderror</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group ">
                            <label>Password</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Your Password" >
                            <label for="password" class="error form-text text-danger"> @error('password') {{ $message }} @enderror</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group ">
                            <label>Password Confirm</label>
                            <input type="password" name="password-confirm" class="form-control  @error('password-confirm') is-invalid @enderror" placeholder="Enter Your Password Confirm" equalTo="#password">
                            <label for="password-confirm" class="error form-text text-danger"> @error('password-confirm') {{ $message }} @enderror</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group ">
                            <label>Role*</label>
                            <select name="role[]" id="" multiple class="form-control select2" multiple data-placeholder="Choose Role" data-allow-clear="1">
                                @foreach ($roles as $role)
                                <option value="{{$role->id}}" @if($user->hasRole($role->name)) selected @endif>{{$role->name}}</option>
                                @endforeach
                            </select>
                            <label for="roles" class="error form-text text-danger"> @error('roles') {{ $message }} @enderror</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        $("#form").validate();
    });
</script>
@endpush