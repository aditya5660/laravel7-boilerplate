@extends('layouts.admin')
@section('title')
    {{$pageTitle}}
@endsection
@section('content')
<small class="d-block text-secondary text-uppercase mb-3">Dashboard</small>
<div class="card">
    <div class="card-body">Hi, {{ Auth::user()->name }} </div>
</div>
@endsection