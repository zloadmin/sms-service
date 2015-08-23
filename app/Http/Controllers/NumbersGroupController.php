<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\NumbersGroup;
use App\Numbers;
use Auth;
use Validator;
use File;
use Excel;

class NumbersGroupController extends Controller
{
    public function index()
    {
        $groups =  Auth::user()->numbersgroup()->paginate(20);


        return View::make('group.list', compact('groups'));
    }

    public function systemindex()
    {
        $groups = NumbersGroup::where('user_id', '=', '0')->paginate(20);

        return View::make('group.system_list', compact('groups'));
    }

    public function view($id)
    {
        $name = Auth::user()->numbersgroup()->find($id)->name;

        $numbers = Auth::user()->numbersgroup()->find($id)->numbers()->paginate(20);

        return View::make('group.view', compact('numbers', 'name'));
    }

    public function system_view($id)
    {

        $name = NumbersGroup::where('user_id', '=', '0')->find($id)->name;

        $numbers = NumbersGroup::where('user_id', '=', '0')->find($id)->numbers()->paginate(20);


        return View::make('group.system_view', compact('numbers', 'name'));
    }

    public function create()
    {
        return View('group.create');
    }

    public function send(Request $request)
    {

        $rules = [
            'name' => 'required',
            'numbers' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $numbers = $request->input('numbers');
            $numbers_array = explode("\n", $numbers);
            $numbers_array = array_unique($numbers_array);
            $add_number = array();

            foreach($numbers_array as $number){

                if($number) {

                    $number = trim($number);
                    $number = str_replace("\t", "", $number);

                    if($number[0]==8) {
                        $number = substr($number, 1);
                        $number = '+7'.$number;

                    }

                    $validator = Validator::make(
                        ['number' => $number],
                        ['number' => 'phone:RU']
                    );

                    if (!$validator->fails()) $add_number[] = $number;
                }

            }

            if(count($add_number)==0) return redirect()->back()->withErrors(['Ошибка добавления. Не один телефон не прошел валидацию.'])->withInput();

            $numbersgroup = new NumbersGroup(['name' => $request->input('name')]);
            $save_ng = Auth::user()->numbersgroup()->save($numbersgroup);


            foreach($add_number as $n){

                $number = new Numbers(['number' => $n]);
                Auth::user()->numbersgroup()->find($save_ng->id)->numbers()->save($number);

            }

            return redirect()->to('number_group/view/'.$save_ng->id);
        }
    }

    public function delete($id)
    {
        $find = Auth::user()->numbersgroup()->find($id);
        if(!$find) return redirect()->back()->with(['error' => 'Ошибка удаления']);
        $message = "Список телефонов &laquo;".$find->name."&raquo; успешно удален!";
        $find->delete();
        return redirect()->back()->with(['success' => $message]);
    }

    public function download($id, Request $request)
    {
        $find = Auth::user()->numbersgroup()->find($id);
        if(!$find) return redirect()->back()->with(['error' => 'Ошибка доступа']);

        if($request->input('format')==="txt") {

            $name = $find->name.".txt";
            $headers = ['Content-Type' => 'text/plain'];
            $pathToFile = base_path().'/tmp/'.str_random(10).".txt";
            $content = '';

            foreach($find->numbers as $number) $content .= $number->number."\n";

            $makefile = File::put($pathToFile, $content);
            if($makefile===false) return redirect()->back()->with(['error' => 'Ошибка создания файла']); //[addlog]
            return response()->download($pathToFile, $name, $headers)->deleteFileAfterSend(true);
        }

        if($request->input('format')==="xls") {

            $name = $find->name.".txt";
            $headers = ['Content-Type' => 'text/plain'];
            $pathToFile = base_path().'/tmp/'.str_random(10).".txt";




            foreach($find->numbers as $number) $content[] = array($number->number);


            Excel::create($find->name, function($excel) use($content) {


                $excel->sheet('Телефоны', function($sheet) use($content) {

                    $sheet->fromArray($content, null, 'A1', false, false);

                });

            })->download('xls');

        }
    }

    public function change()
    {
        $user_groups =  Auth::user()->numbersgroup()->get();

        $system_groups = NumbersGroup::where('user_id', '=', '0')->get();

        return View::make('group.change', compact('user_groups', 'system_groups'));
    }
    public function ajax_add_group($id, Request $request)
    {
        $data = array();

        $group = NumbersGroup::find($id);


        if(!$group) {
            $data['status'] = 'false';
            $data['message'] = 'Ошибка добавления. Данный список не найден'; //[addlog]
        } elseif(($group->user_id === 0 AND $group->user_id !== Auth::id()) === false AND ($group->user_id !== 0 AND $group->user_id === Auth::id()) === false) {
            $data['status'] = 'false';
            $data['message'] = 'Ошибка добавления. Ошибка доступа'; //[addlog]
        } else {
            $data['status'] = 'true';
            $data['message'] = 'Список 	&laquo;'.$group->name.'&raquo; добавлен'; //[addlog]
        }

        return response()->json($data);

    }
}
