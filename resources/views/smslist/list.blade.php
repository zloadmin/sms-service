@extends('master')
@section('main')

    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Сообщение</th>
            <th>Колчиество номеров</th>
            <th>Просмотреть</th>
        </tr>
        </thead>
        <tbody>
        @foreach($smslists as $smslist)
            <tr>
                <td>{{ $smslist->id }}</td>
                <td>{{ $smslist->message }}</td>
                <td>колво</td>
                <td><a href="/smslist/view/{{ $smslist->id }}" class="btn btn-success">Просмотреть</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $smslists->render() !!}
@stop