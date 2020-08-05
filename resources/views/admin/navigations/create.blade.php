@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')    
<div class="page-inner">
    @include('layouts.alert')
    <div class="card">
        <form method="POST" action="{{route('admin.navigations.store')}}">
            @csrf
            @method('POST')
            <div class="card-header bg-white">
                <div class="h4 text-primary">
                    Create Navigation
                    <a href="{{route('admin.navigations.index')}}" class="float-right btn btn-outline-success btn-sm">
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
                        <label>Parent Navigation</label>
                        <select name="parent_id" class="form-control @error('parent_id') is-invalid @enderror select2" data-placeholder="Please Select Navigation" required="">
                            <option value="0" selected>Its a Parent</option>
                            @foreach ($navigations as $item)
                            <option value="{{$item->id}}" @if ($item->id == old('parent_id')) selected @endif>{{$item->name}}</option>
                            @endforeach
                        </select>
                        @error('parent_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Navigation Name" value="{{old('name')}}" required="">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                        <label>Nav icon</label>
                        <input type="text" name="url" class="form-control @error('url') is-invalid @enderror" placeholder="Enter Navigation Url " value="{{old('url')}}" required="">
                        @error('url')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                        <label>Nav Order</label>
                        <input type="number" name="order" class="form-control @error('order') is-invalid @enderror" placeholder="Enter Navigation Order " value="{{old('order')}}" required="">
                        @error('order')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                        <label>Nav Icon</label>
                        <input type="text" name="icon" class="form-control @error('icon') is-invalid @enderror" placeholder="Enter Navigation Icon " value="{{old('icon')}}" required="">
                        @error('icon')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                        <label>Permission Name</label>
                        <select name="permission_name" class="form-control @error('permission_name') is-invalid @enderror select2" data-placeholder="Please Select Permissions to Navigation" required="">
                            <option value="0" selected>Select Permissions</option>
                            @foreach ($permissions as $item)
                            <option value="{{$item->id}}" @if ($item->name == old('permission_name')) selected @endif>{{$item->name}}</option>
                            @endforeach
                        </select>
                        @error('permission_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
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