<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class SMSListController extends Controller
{

    public function create()
    {
        return View('smslist.create');
    }


    public function send()
    {
        return dd($_POST);
    }
}
