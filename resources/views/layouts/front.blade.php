@extends('layouts.base')
@section('body')    
<x-layouts.navigation></x-layouts>
<main class="py-4">
    @yield('content')
</main>

@endsection