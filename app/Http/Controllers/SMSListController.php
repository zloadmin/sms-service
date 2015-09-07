<?php

namespace App\Http\Controllers;

use App\NumbersGroup;
use App\SMSList;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Validator;
use App\Components\CarbonAfternoon;
use Auth;
use App\Messages;
use Excel;

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

        $AllNumbers= array();

        if(count(Session::get('list')) != 0) {
            foreach(Session::get('list') as $i => $v){
                $group = NumbersGroup::find($i);
                $numbers = $group->numbers()->get();
                foreach($numbers as $v) {
                    if($group->user_id==0)  {
                        $AllNumbers[] = ['type' => '1', 'number' => $v->number];
                    }
                    if($group->user_id==Auth::id()) {
                        $AllNumbers[] = ['type' => '2', 'number' => $v->number];
                    }
                }
            }
        }

        if($request->input('number')) $AllNumbers[] = ['type' => '3', 'number' => $request->input('number')];

        $count = count($AllNumbers);

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
                $period = $date_stop->timestamp - $start->timestamp;
                if($period >= ($count*2)) {
                    $stop = $date_stop;
                }

            }
        }

        $date_array = array();

        $interval = intval($request->input('period'));

        if($request->input('smoothly')==2 AND $interval >= 1) {
            $date_array = CarbonAfternoon::getDatesInterval($start, $interval, $count);
        } else {
            if($start AND !isset($stop)) {
                for($i = 1; $i<=$count;$i++) $date_array[] = $start->toDateTimeString();
            } elseif ($start AND isset($stop)) {
                $date_array = CarbonAfternoon::getDatesIntervalWithStop($start, $stop, $count);

            }
        }

        $AllNumbersWitDate = array();
//        $date_array = array_dot($date_array);

        foreach($AllNumbers as $i => $v) {
            $AllNumbersWitDate[$i] = $v;
            $AllNumbersWitDate[$i] = array_add($AllNumbersWitDate[$i], 'date', $date_array[$i]);

        }

        if(!isset($stop)) $stop = '';

        $add_smslist = SMSList::create([
            'user_id' => Auth::id(),
            'message' => $request->input('message'),
            'smoothly' => $request->input('smoothly'),
            'start' => $start,
            'stop' => $stop,
            'period' => $interval,
            'draft' => true
        ]);

        foreach($AllNumbersWitDate as $v) {
            Messages::create([
                'smslist' => $add_smslist->id,
                'type' => $v['type'],
                'need_send' => $v['date'],
                'number' => $v['number'],
                'status' => 1
            ]);
        }

        Session::forget('list');

        return redirect('/smslist/view/'.$add_smslist->id);

    }

    public function view($id)
    {
        $smslist = Auth::user()->smslist()->find($id);
        $messages = $smslist->messages()->orderBy('need_send', 'asc')->paginate(50);
        return View('smslist.view', compact('smslist', 'messages'));
    }
    public function download($id)
    {

        if(!Auth::user()->smslist()->find($id)) return redirect()->back()->with(['error' => 'Ошибка доступа']);

        $message = Auth::user()->smslist()->find($id)->message;

        $messages = Auth::user()->smslist()->find($id)->messages()->get();


        $all_message = array();

        $all_message[] = [
            0 => "ID",
            1 => "Дата отправки",
            2 => "Номер телефона",
            3 => "Сообщение",
            4 => "Статус"
        ];

        foreach($messages as $v) {

            switch ($v->status) {
                case 1:
                    $status = "Черновик";
                    break;
                case 2:
                    $status = "Отправлено";
                    break;
            }
            $all_message[] = [
                0 => $v->id,
                1 => $v->need_send,
                2 => $v->number,
                3 => $message,
                4 => $status
            ];

        }


        $name = "Сообщения";
        $headers = ['Content-Type' => 'text/plain'];
        $pathToFile = base_path().'/tmp/'.str_random(10).".xls";


        Excel::create($name, function($excel) use($all_message) {


            $excel->sheet('Сообщения', function($sheet) use($all_message) {

                $sheet->fromArray($all_message, null, 'A1', false, false);

            });

        })->download('xls');





    }
    public function start_send($id)
    {
        Auth::user()->smslist()->find($id)->update(['draft' => false]);

        Auth::user()->smslist()->find($id)->messages()->update(['status' => 2]);

        return redirect('/smslist/view/'.$id);
    }
    public function index()
    {

        $smslists = Auth::user()->smslist()->notdraft()->paginate(50);



        return View('smslist.list', compact('smslists'));
    }
    public function index_draft()
    {
        $smslists = Auth::user()->smslist()->draft()->paginate(50);

        return View('smslist.list', compact('smslists'));
    }
}
