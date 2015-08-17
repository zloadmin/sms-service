@extends('master')
@section('main')
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Название</th>
                <th>Скачать</th>
                <th>Удалить</th>
            </tr>
        </thead>
        <tbody>
            @foreach($groups as $group)
                <tr>
                    <td>{{ $group->id }}</td>
                    <td><a href="{!!URL::to('number_group/view/'.$group->id)!!}">{{ $group->name }}</a></td>
                    <td>_</td>
                    <td>_</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $groups->render() !!}
@stop