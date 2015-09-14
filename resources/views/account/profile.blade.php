@extends('master')
@section('main')
<div class="col-md-5 col-md-offset-3">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">
                @if(Auth::user()->nickname)
                    {{ Auth::user()->nickname }}
                @else
                    {{ Auth::user()->name }}
                @endif
            </h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3 col-lg-3 " align="center">
                    @if(Auth::user()->avatar)
                        <img src="{{ Auth::user()->avatar }}" class="img-circle img-responsive" alt="avatar" width="300" height="300">
                    @else
                        <img src="/static/images/noavatar.png" class="img-circle img-responsive" alt="avatar" width="300" height="300">
                    @endif
                </div>
                <div class="col-md-9 col-lg-9">
                    <table class="table table-user-information">
                        <tbody>
                            @if(Auth::user()->nickname)
                                <tr>
                                    <td>Nick Name</td>
                                    <td>{{ Auth::user()->nickname }}</td>
                                </tr>
                            @endif

                            @if(Auth::user()->name)
                                <tr>
                                    <td>Name</td>
                                    <td>{{ Auth::user()->name }}</td>
                                </tr>
                            @endif

                            @if(Auth::user()->email)
                                <tr>
                                    <td>Email</td>
                                    <td>{{ Auth::user()->email }}</td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
                </div>
        </div>
    </div>
</div>
@stop