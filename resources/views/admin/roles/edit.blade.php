@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')    
<div class="page-inner">
    @include('layouts.alert')
    <div class="card">
        <form method="POST" action="{{route('admin.roles.update',$role)}}">
            @csrf
            @method('PUT')
            <div class="card-header bg-white">
                <div class="h4 text-primary">
                    {{$pageTitle}}
                    <a href="{{route('admin.roles.index')}}" class="float-right btn btn-outline-success btn-sm">
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
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Your Name" value="{{$role->name}}" required="">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
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