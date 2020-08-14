@extends('layouts.base')
@push('styles')
<link rel="stylesheet" href="{{asset('atlantis/fonts/line-awesome/line-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('atlantis/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('atlantis/css/atlantis.css')}}">
<link rel="stylesheet" href="{{asset('atlantis/css/pace.css')}}">
<link rel="stylesheet" href="{{asset('atlantis/plugins/select2/select2.full.css')}}">
<script src="{{asset('atlantis/js/pace.min.js')}}"></script>
<script src="{{asset('atlantis/plugins/webfont/webfont.min.js')}}"></script>
<script>
    WebFont.load({
        google: {"families":["Lato:300,400,700,900"]},
        custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons","line-awesome"], urls: ['{{asset("atlantis/css/fonts.min.css")}}']},
        active: function() {
            sessionStorage.fonts = true;
        }
    });
</script>
@endpush
@section('body')
<div class="wrapper">
    <x-layouts.navigation></x-layouts.navigation>
    <x-layouts.sidebar></x-layouts.sidebar>
    <div class="main-panel">
        <div class="content mt-0">
            @yield('content')
        </div>
        @include('layouts.admin.footer')
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="{{ asset('atlantis/plugins/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
<script src="{{ asset('atlantis/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>
<script src="{{ asset('atlantis/plugins/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
<script src="{{ asset('atlantis/plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
<script src="{{ asset('atlantis/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{ asset('atlantis/js/atlantis.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: "bootstrap",
        });
    });
</script>
@endpush

