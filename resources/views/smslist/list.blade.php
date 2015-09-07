@extends('master')
@section('main')

    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Добавлено</th>
            <th>Сообщение</th>
            <th>Колчиество получателей</th>
            <th>Скачать</th>
            <th>Просмотреть</th>
        </tr>
        </thead>
        <tbody>
        @foreach($smslists as $smslist)
            <tr>
                <td>{{ $smslist->id }}</td>
                <td>{{ $smslist->created_at }}</td>
                <td>{{ $smslist->message }}</td>
                <td>{{ $smslist->messages()->count() }}</td>
                <td><a href="/smslist/download/{{ $smslist->id }}" class="btn btn-danger"><span class="glyphicon glyphicon-download-alt"></span> Скачать</a></td>
                <td><a href="/smslist/view/{{ $smslist->id }}" class="btn btn-success"><span class="glyphicon glyphicon-search"></span> Просмотреть</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $smslists->render() !!}
@stop