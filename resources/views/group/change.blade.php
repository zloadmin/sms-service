@extends('master')
@section('main')
    <a href="/smslist/create" class="btn btn-primary" style="margin-bottom: 20px;"><i class="glyphicon glyphicon-backward"></i> Вернуться</a>
    
    <ul class="nav nav-tabs">
        <li class="active"><a href="#user_groups" data-toggle="tab">Мои списки</a></li>
        <li><a href="#system_groups" data-toggle="tab">Стандартные списки</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active" id="user_groups">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Название</th>
                        <th>Количество номеров</th>
                        <th>Добавить</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($user_groups as $user_group)
                    <tr>
                        <td>{{ $user_group->id }}</td>
                        <td><a href="{!! URL::to('number_group/view/'.$user_group->id) !!}">{{ $user_group->name }}</a></td>
                        <td>{{ $user_group->numbers()->count() }}</td>
                        <td>
                            {!! Form::open(array('url' => '/number_group/ajax/add_group/'.$user_group->id, 'method' => 'post')) !!}
                            {!! Form::submit('Добавить', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane" id="system_groups">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Название</th>
                    <th>Количество номеров</th>
                    <th>Добавить</th>
                </tr>
                </thead>
                <tbody>
                @foreach($system_groups as $system_group)
                    <tr>
                        <td>{{ $system_group->id }}</td>
                        <td><a href="{!!URL::to('number_group/system_view/'.$system_group->id)!!}">{{ $system_group->name }}</a></td>
                        <td>{{ $system_group->numbers()->count() }}</td>
                        <td>
                            {!! Form::open(array('url' => '/number_group/ajax/add_group/'.$system_group->id, 'method' => 'post')) !!}
                            {!! Form::submit('Добавить', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop