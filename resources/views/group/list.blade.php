@extends('master')
@section('main')

    @if (Session::has('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p>{!! Session::get('error') !!}</p>
        </div>
    @endif

    @if (Session::has('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p>{!! Session::get('success') !!}</p>
        </div>
    @endif
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
                    <td>
                        {!! Form::open(array('url' => '/number_group/download/'.$group->id, 'method' => 'post')) !!}
                            <div class="btn-group">
                                {!! Form::button('Текстовым файлом', ['class' => 'btn btn-default', 'value' => 'txt', 'type' => 'submit', 'name' => 'format']) !!}

                                {!! Form::button('Exel файлом', ['class' => 'btn btn-default', 'value' => 'xls', 'type' => 'submit', 'name' => 'format']) !!}
                            </div>
                        {!! Form::close() !!}
                    </td>
                    <td>
                        {!! Form::open(array('url' => '/number_group/delete/'.$group->id, 'method' => 'delete')) !!}
                        {!! Form::submit('Удалить', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $groups->render() !!}
@stop