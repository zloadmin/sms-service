@extends('master')
@section('main')

    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Добавлено</th>
            <th>Сообщение</th>
            <th>Колчиество получателей</th>
            <th>Просмотреть</th>
        </tr>
        </thead>
        <tbody>
        @foreach($smslists as $smslist)
            <tr>
                <td>{{ $smslist->id }}</td>
                <td>{{ $smslist->created_at }}</td>
                <td>{{ $smslist->message }}</td>
                <td>кол</td>
                <td><a href="/smslist/view/{{ $smslist->id }}" class="btn btn-success">Просмотреть</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $smslists->render() !!}
@stop