<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Redirect;
use Socialite;
use Auth;

class AccountController extends Controller
{
    //github
    public function github_redirect() {
        return Socialite::with('github')->redirect();
    }

    public function github() {
        $user = Socialite::with('github')->user();
        return User::FindOrCreateUserAuth($user, 'github');

    }

    //google
    public function google_redirect() {
        return Socialite::with('google')->redirect();
    }

    public function google() {
        $user = Socialite::with('google')->user();
        return User::FindOrCreateUserAuth($user, 'google');


    }




    public function getLogout() {

        Auth::logout();
        return redirect('/');

    }


}
