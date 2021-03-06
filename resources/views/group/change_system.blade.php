@extends('master')
@section('main')
    <a href="/smslist/create" class="btn btn-primary" style="margin-bottom: 20px;"><i class="glyphicon glyphicon-backward"></i> Вернуться к списку рассылки</a>

    <ul class="nav nav-tabs">
        <li><a href="/number_group/change_users">Мои абоненты</a></li>
        <li class="active"><a href="/number_group/change_system">Абоненты сервиса</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div>
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
                            {!! Form::open(array('url' => '/number_group/ajax/add_or_remove_group/'.$system_group->id, 'method' => 'get', 'class' => 'addgroup')) !!}
                            @if(Session::has('list.'.$system_group->id))
                                {!! Form::button('Удалить', [
                                'class' => 'btn btn-danger',
                                'type' => 'submit',
                                'data-loading-text' => 'Загрузка...',
                                'value' => 'delete',
                                'name' => 'type',
                                'autocomplete' => 'off',
                                'data-delete-text' => 'Удалить',
                                'data-add-text' => 'Добавить'
                                ]) !!}
                            @else
                                {!! Form::button('Добавить', [
                                'class' => 'btn btn-primary',
                                'type' => 'submit',
                                'data-loading-text' => 'Загрузка...',
                                'value' => 'add',
                                'name' => 'type',
                                'autocomplete' => 'off',
                                'data-delete-text' => 'Удалить',
                                'data-add-text' => 'Добавить'
                                ]) !!}
                            @endif
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop