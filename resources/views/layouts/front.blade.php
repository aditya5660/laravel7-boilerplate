@extends('layouts.base')
@section('styles')
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <style>
        body{
            font-family: 'Nunito Sans', sans-serif;
        }
    </style>
    <!-- Styles -->
@endsection
@section('body')    
<x-layouts.navigation></x-layouts>
<main class="py-4">
    @yield('content')
</main>

@endsection