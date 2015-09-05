@extends('master')
@section('main')

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Название</th>
                <th>Колиество номеров</th>
            </tr>
        </thead>
        <tbody>
            @foreach($groups as $group)
                <tr>
                    <td>{{ $group->id }}</td>
                    <td><a href="{!!URL::to('number_group/system_view/'.$group->id)!!}">{{ $group->name }}</a></td>

                    <td>
                        {{ $group->numbers()->count() }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $groups->render() !!}

@stop