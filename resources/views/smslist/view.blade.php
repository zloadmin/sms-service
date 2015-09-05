@extends('master')
@section('main')
    <div class="col-md-12">
        <h4>Сообщение</h4>
        <blockquote  class="text-danger">
            {!! $smslist->message !!}
        </blockquote>
        <h4>Получатели</h4>
        <table class="table table-condensed table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Дата отправки</th>
                <th>Номер телефона</th>
                <th>Статус</th>
            </tr>
            </thead>
            <tbody>
                @foreach($messages as $message)
                    <tr>
                        <td><p>{{ $message->id }}</p></td>
                        <td><p>{{ $message->need_send }}</p></td>
                        <td>
                            <p>
                                @if($message->type == 1)
                                    {{ substr_replace($message->number, '****', -4) }}
                                @else
                                    {{ $message->number }}
                                @endif
                            </p>
                        </td>
                        <td>
                            <p>
                                @if($message->status==1)
                                    Черновик
                                @elseif($message->status==2)
                                    Отправка
                                @endif
                            </p>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $messages->render() !!}
        @if($smslist->draft)
            {!! Form::open(array('url' => '/smslist/start_send/'.$smslist->id, 'method' => 'post')) !!}
            {!! Form::submit('Разослать', ['class' => 'btn btn-danger btn-lg center-block']) !!}
            {!! Form::close() !!}
        @endif
    </div>
@stop