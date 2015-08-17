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
                <form method="POST" action="/number_group/send" class="form-horizontal" role="form">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="number">Навзвание</label>
                        <div class="col-sm-4">
                            <input placeholder="Новый список" value="{{ old('name') }}" type="text" name="name" class="form-control col-sm-6">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="message">Номера телефонов (списком)</label>
                        <div class="col-sm-10">
                            <textarea placeholder="+79123456789" name="numbers" class="form-control" style="height: 200px;">{{ old('numbers') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success center-block">Добавить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop