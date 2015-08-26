@extends('master')
@section('main')
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Новая рассылка</h3>
            </div>
            <div class="panel-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="/smslist/send" class="form-horizontal" role="form">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="number">Номер</label>
                        <div class="col-sm-4">
                            <input placeholder="+79512345678" type="text" name="number" id="number" value="{{ old('number') }}" class="form-control col-sm-6">
                        </div>
                        @if($count>=1)
                            <div class="col-sm-2">
                                <a class="btn btn-primary" href="/number_group/change">Выбрано списков: {{$count}}</a>
                            </div>
                            <div class="col-sm-2">
                                <a class="btn btn-danger" href="/number_group/remove_all_group">Отчистить</a>
                            </div>
                        @else
                        <a class="col-sm-2 btn btn-primary" href="/number_group/change">Выбрать из списка</a>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="message">Сообщение</label>
                        <div class="col-sm-10">
                            <textarea placeholder="Привет!" name="message" id="message" class="form-control">{{ old('message') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Дополнительные параметры рассылки</a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        Начать рассылку в <input name="date_start" id="date_timepicker_start" type="text" value="" class="form-control" />
                                                    </div>
                                                    <div class="col-sm-6">
                                                        Закончить рассылку в <input name="date_stop" id="date_timepicker_end" type="text" value="" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group period">
                                            <div class="col-sm-6">
                                                <div class="radio">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="smoothly" value="true" onchange="$('.setperiod').addClass('invisible');" checked> Плавная отправка
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="smoothly" value="false" id="smoothlyfalse" onchange="$('.setperiod').removeClass('invisible');"> Указать период
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group invisible setperiod">
                                                    <label class="col-sm-4 control-label" for="number" style="text-align: left">Период (минут)</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" name="period" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success btn-lg center-block">Разослать сообщения</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop