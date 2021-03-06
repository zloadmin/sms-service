@extends('master')
@section('main')
    <h1>Список рассылки "{{ $name}}"</h1>
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Номер</th>
        </tr>
        </thead>
        <tbody>
        @foreach($numbers as $number)
            <tr>
                <td>{{ $number->id }}</td>
                <td>{{ $number->number }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $numbers->render() !!}
@stop