@extends('layouts.admin')
@section('title')
    Create User
@endsection
@section('content')    
<div class="page-inner">
    @include('layouts.alert')
    <div class="card">
        <form method="POST" action="{{route('admin.users.store')}}">
            @csrf
            @method('POST')
            <div class="card-header bg-white">
                <div class="h4 text-primary">
                    Create User
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
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Your Name" value="{{old('name')}}" required="">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Your Email" value="{{old('email')}}" required="" >
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Your Password" required="" >
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                        <label>Password Confirm</label>
                        <input type="password" name="password-confirm" class="form-control  @error('password-confirm') is-invalid @enderror" placeholder="Enter Your Password Confirm" required="">
                        @error('password-confirm')
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
                            <option value="{{$role->id}}" {{in_array($role->id, old('role') ?? array()) ? 'selected' : '' }}>{{$role->name}}</option>
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
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection
@push('js')
    
@endpush