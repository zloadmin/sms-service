<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="">sms-service</a>
        </div>
        <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    @if((Auth::check()))
                        <li class="dropdown navbar-profile">
                            <a aria-expanded="false" href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="meta">
                                    <span class="avatar">
                                        @if(Auth::user()->avatar)
                                            <img src="{{ Auth::user()->avatar }}" class="img-circle" alt="avatar">
                                        @else
                                            <img src="/static/images/noavatar.png" class="img-circle" alt="avatar">
                                        @endif
                                    </span>
                                    <span class="text hidden-xs hidden-sm text-muted">
                                        @if(Auth::user()->nickname)
                                            {{ Auth::user()->nickname }}
                                        @else
                                            {{ Auth::user()->name }}
                                        @endif
                                    </span>
                                    <span class="caret"></span>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header">Профиль</li>
                                <li><a href="/profile"><i class="fa fa-user"></i> Просмотреть профиль</a></li>
                                <li><a href="/balance"><i class="fa fa-money"></i> Баланс <span class="badge">42 руб.</span></a></li>
                                <li class="divider"></li>
                                <li><a href="{!!URL::to('oauth/logout')!!}"><i class="fa fa-sign-out"></i>{{ trans('all.logout') }}</a></li>
                            </ul>
                        </li>
                    @else
                        <li class="dropdown ghi"><a href="{!!URL::to('oauth/github')!!}"><i class="fa fa-github"></i></a></li>
                        <li class="dropdown gpi"><a href="{!!URL::to('oauth/google')!!}"><i class="fa fa-google-plus"></i></a></li>
                        <li class="dropdown fbi"><a href="{!!URL::to('oauth/facebook')!!}"><i class="fa fa-facebook"></i></a></li>
                        <li class="dropdown twi"><a href="{!!URL::to('oauth/twitter')!!}"><i class="fa fa-twitter"></i></a></li>
                    @endif
                    <li class="dropdown navbar-flags">
                        <a href="#" class="dropdown-toggle" id="flag-menu-btn" data-toggle="dropdown">
                            <img src="/static/images/{{ trans('all.htmllang') }}.png" alt="ENG" width="32" height="32" />
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="/setlocale/ru"><img src="/static/images/ru.png" alt="ru"> Русский</a></li>
                            <li><a href="/setlocale/en"><img src="/static/images/en.png" alt="en"> English</a></li>
                        </ul>
                    </li>
                </ul>
        </div>
    </div>
</div>