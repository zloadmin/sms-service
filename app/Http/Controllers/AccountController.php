<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Redirect;
use Socialite;


class AccountController extends Controller
{

    public function github_redirect() {
        return Socialite::with('github')->redirect();
    }

    public function github() {
        $user = Socialite::with('github')->user();
        // Do your stuff with user data.
        print_r($user);die;
    }


}
