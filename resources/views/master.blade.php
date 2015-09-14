<!doctype html>
<html lang="{{ trans('all.htmllang') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ trans('message.welcome') }}</title>
    <link href="{{ asset("/static/css/bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("/static/css/font-awesome.min.css") }}" rel="stylesheet">
    <link href="{{ asset("/static/css/jquery.datetimepicker.css") }}" rel="stylesheet">
    <link href="{{ asset("/static/css/style.css") }}" rel="stylesheet">
</head>
<body>
@include('navbar')
<div class="container-fluid">
    <div class="row">
        @if((Auth::check()))
            @include('sidebar')
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                @yield('main')
            </div>
        @else
            @include('leding')
        @endif
    </div>
</div>
<script src="{{ asset("/static/js/jquery-1.11.3.min.js") }}"></script>
<script src="{{ asset("/static/js/jquery.datetimepicker.js") }}"></script>
<script src="{{ asset("/static/js/bootstrap.min.js") }}"></script>
<script src="{{ asset("/static/js/scripts.js") }}"></script>
</body>
</html>