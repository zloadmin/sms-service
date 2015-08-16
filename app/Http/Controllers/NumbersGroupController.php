<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\NumbersGroup;
use Auth;

class NumbersGroupController extends Controller
{
    public function index()
    {
        $groups =  Auth::user()->numbersgroup; //add pagination


        return View::make('group.list', compact('groups'));
    }
}
