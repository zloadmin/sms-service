<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Validator;
use App\Components\CarbonAfternoon;

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

            $date_start = CarbonAfternoon::parse($request->input('date_start'));
            if($date_start->timestamp >= CarbonAfternoon::now()->timestamp) {
                $start = $date_start->startOfAfternoon();
            } else {
                $start = CarbonAfternoon::now()->startOfAfternoon();
            }

        } else {
            $start = CarbonAfternoon::now()->startOfAfternoon();
        }

        if($request->input('date_stop')!=="") {
            $date_stop = CarbonAfternoon::parse($request->input('date_stop'))->startOfAfternoon();

            if($date_stop->timestamp > $start->timestamp) {
                $stop = $date_stop;
            }
        }
        $count = 100;
        $data_array = array();
        $interval = intval($request->input('period'));

        if($request->input('smoothly')==2 AND $interval >= 1) {
            $data_array[] = CarbonAfternoon::getDatesInterval($start, $interval, $count);
        } else {
            if($start AND !isset($stop)) {
                for($i = 1; $i<=$count;$i++) $data_array[] = $start->toDateTimeString();
            } elseif ($start AND isset($stop)) {
                $data_array[] = CarbonAfternoon::getDatesIntervalWithStop($start, $stop, $count);
            }
        }

        var_dump($data_array);

    }
}
