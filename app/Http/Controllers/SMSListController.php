<?php

namespace App\Http\Controllers;

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
            'number' => 'required|phone:RU'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            return dd($_POST);
        }


    }
}
