@extends('layouts.admin')
@section('title')
    Role
@endsection
@section('content')    
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title ">Role</h4>
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
                <a href="{{route('admin.roles.index')}}">Role</a>
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
        <form method="POST" action="{{route('admin.roles.update',$role)}}" id="form">
            @csrf
            @method('PUT')
            <div class="card-header d-flex d-justify-content-between">
                <div class="card-title font-weight-bold">Edit Role</div>
                <div class="ml-auto">
                    <a href="{{route('admin.roles.index')}}" class="btn btn-default btn-sm shadow">
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
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Your Name" value="{{$role->name}}" required="">
                            <label for="name" class="error form-text text-danger"> @error('name') {{ $message }} @enderror</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
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