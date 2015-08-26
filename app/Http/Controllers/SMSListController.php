<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Validator;

class SMSListController extends Controller
{

    public function create()
    {
        $count = count(Session::get('list'));
        return View('smslist.create')->with(['count' => $count]);
    }


    public function send(Request $request)
    {

        $rules = [
            'message' => 'required|max:1500'
        ];

        $messages = [
            'message.required' => 'Поле сообщение обязательно для заполнения',
            'message.max' => 'Размер сообщения не более 1500 символов',
            'number.required' => 'Впишите номер для отправки или выберете из базы',
            'number.phone' =>  'Неверный формат номера',
        ];

        //validation
        if(count(Session::get('list'))===0 AND $request->input('number')==="") {

            $rules = array_add($rules, 'number', 'required');

        } elseif(count(Session::get('list'))===0 AND $request->input('number')!=="") {

            $rules = array_add($rules, 'number', 'phone:RU');

        }

        $validator = Validator::make($request->all(), $rules, $messages);


        if ($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();

        //valid fields
        if($request->input('date_start')!=="") {

            $date_start = Carbon::parse($request->input('date_start'));
            if($date_start->timestamp > Carbon::now()->timestamp) {
                $start = $date_start->toDateTimeString();
            } else {
                $start = Carbon::now()->toDateTimeString();
            }

        } else {
            $start = Carbon::now()->toDateTimeString();
        }

        if($request->input('date_stop')!=="") {
            $date_stop = Carbon::parse($request->input('date_stop'));
            $date_start = Carbon::parse($start);
            if($date_stop->timestamp > $date_start->timestamp) {
                $stop = $date_stop->toDateTimeString();
            }
        }



    }
}
