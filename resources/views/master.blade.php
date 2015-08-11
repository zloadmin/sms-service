<!doctype html>
<html lang="{{ trans('all.htmllang') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ trans('message.welcome') }}</title>
    <link href="{{ asset("/static/styles/bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("/static/styles/style.css") }}" rel="stylesheet">
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-collapse collapse">
            <div class="navbar-form navbar-right">
                @if((Auth::check()))
                    <a class="btn btn-danger" href="/auth/logout">Log Out</a>
                @else
                    <a href="/auth/login" class="btn btn-success">Log In</a>
                    <a href="/auth/register" class="btn btn-primary">Sign Up</a>
                @endif

                    <a href="{!!URL::to('oauth/github')!!}" class="btn">Login with Github</a>

                <div class="btn-group">
                    <a href="/setlocale/en" class="btn btn-default">English</a>
                    <a href="/setlocale/ru" class="btn btn-default">Русский</a>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        @yield('main')
    </div>
</div>
</body>
</html>