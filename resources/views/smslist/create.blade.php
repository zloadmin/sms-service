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
                        <div class="col-sm-10">
                            <input type="text" name="number" id="number" value="{{ old('number') }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="message">Сообщение</label>
                        <div class="col-sm-10">
                            <textarea name="message" id="message" class="form-control">{{ old('message') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="planing" id="planing" onchange="$('.planing').toggle();"> Запланировать рассылку
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="planing hidden">
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="planing_type" value="1"  id="planing_type1" onchange="$('.planing_type1').show(); $('.planing_type2').hide();$('.period').hide();" checked> Отправить в указаное время
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="planing_type" value="2" id="planing_type2" onchange="$('.planing_type1').hide(); $('.planing_type2').show(); $('.period').show();"> Отправить в указаный период
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group planing_type1">
                            <div class="col-sm-offset-2 col-sm-10">
                                календарь
                            </div>
                        </div>
                        <div class="form-group planing_type2 hidden">
                            <div class="col-sm-offset-2 col-sm-10">
                                календарь1 календарь2
                            </div>
                        </div>
                        <div class="form-group period hidden">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="smoothly" value="true" onchange="$('.setperiod').hide();" checked> Плавная отправка
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group period hidden">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="smoothly" value="false" id="smoothlyfalse" onchange="$('.setperiod').toggle();"> Указать период
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group hidden setperiod">
                            <label class="col-sm-2 control-label" for="number">Период (минут)</label>
                            <div class="col-sm-10">
                                <input type="number" name="period" class="form-control">
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