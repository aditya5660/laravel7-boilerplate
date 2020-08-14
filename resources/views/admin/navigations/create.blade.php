@extends('layouts.admin')
@section('title')
    Navigation
@endsection
@section('content')    
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title ">Navigation</h4>
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
                <a href="{{route('admin.navigations.index')}}">Navigation</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item text-primary">
                Create
            </li>
        </ul>
    </div>
    @include('layouts.alert')
    <div class="card">
        <form method="POST" action="{{route('admin.navigations.store')}}" id="form">
            @csrf
            @method('POST')
            <div class="card-header d-flex d-justify-content-between">
                <div class="card-title font-weight-bold">Create Navigations</div>
                <div class="ml-auto">
                    <a href="{{route('admin.navigations.index')}}" class="btn btn-default btn-sm shadow">
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
                            <label>Parent Navigation*</label>
                            <select name="parent_id" id="parent_id" class="form-control @error('parent_id') is-invalid @enderror select2" data-placeholder="Please Select Navigation" required="">
                                <option value="0" selected>Its a Parent</option>
                                @foreach ($navigations as $item)
                                <option value="{{$item->id}}" @if ($item->id == old('parent_id')) selected @endif>{{$item->name}}</option>
                                @endforeach
                            </select>
                            <label for="parent_id" class="error form-text text-danger"> @error('parent_id') {{ $message }} @enderror</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group ">
                            <label>Name*</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Navigation Name" value="{{old('name')}}" required="">
                            <label for="name" class="error form-text text-danger"> @error('name') {{ $message }} @enderror</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group ">
                            <label>Nav icon*</label>
                            <input type="text" name="url" id="url" class="form-control @error('url') is-invalid @enderror" placeholder="Enter Navigation Url " value="{{old('url')}}" required="">
                            <label for="url" class="error form-text text-danger"> @error('url') {{ $message }} @enderror</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group ">
                            <label>Nav Order*</label>
                            <input type="number" name="order" id="order" class="form-control @error('order') is-invalid @enderror" placeholder="Enter Navigation Order " value="{{old('order')}}" required="">
                            <label for="order" class="error form-text text-danger"> @error('order') {{ $message }} @enderror</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group ">
                            <label>Nav Icon*</label>
                            <input type="text" name="icon" class="form-control @error('icon') is-invalid @enderror" placeholder="Enter Navigation Icon " value="{{old('icon')}}" required="">
                            <label for="icon" class="error form-text text-danger"> @error('icon') {{ $message }} @enderror</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group ">
                            <label>Permissions *</label>
                            <select name="permission_name" class="form-control @error('permission_name') is-invalid @enderror select2"  data-placeholder="Please Select Permissions to Navigation" required>
                                <option value="0" selected>Select Permissions</option>
                                @foreach ($permissions as $item)
                                <option value="{{$item->id}}" @if ($item->name == old('permission_name')) selected @endif>{{$item->name}}</option>
                                @endforeach
                            </select>
                            <label for="permission_name" class="error form-text text-danger"> @error('permission_name') {{ $message }} @enderror</label>
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