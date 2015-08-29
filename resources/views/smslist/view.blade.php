@extends('master')
@section('main')
    <div class="col-md-12">
        <h1>Сообщение</h1>
        <blockquote>
            {!! $smslist->message !!}
        </blockquote>
        <table class="table">
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
                        <td>{{ $message->id }}</td>
                        <td>{{ $message->need_send }}</td>
                        <td>
                            @if($message->type == 1)
                                {{ substr_replace($message->number, '****', -4) }}
                            @else
                                {{ $message->number }}
                            @endif

                        </td>
                        <td>
                            @if($message->status==1)
                                <p>Черновик</p>
                            @elseif($message->status==2)
                                <p>Отправка</p>
                            @endif
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