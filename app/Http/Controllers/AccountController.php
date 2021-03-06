<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

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
        User::FindOrCreateUserAuth($user, 'github');
        return redirect('/smslist/create');

    }

    //google
    public function google_redirect() {
        return Socialite::with('google')->redirect();
    }

    public function google() {
        $user = Socialite::with('google')->user();
        User::FindOrCreateUserAuth($user, 'google');
        return redirect('/smslist/create');
    }

    //facebook
    public function facebook_redirect() {
        return Socialite::with('facebook')->redirect();
    }

    public function facebook() {
        $user = Socialite::with('facebook')->user();
        User::FindOrCreateUserAuth($user, 'facebook');
        return redirect('/smslist/create');
    }

    //twitter
    public function twitter_redirect() {
        return Socialite::with('twitter')->redirect();
    }

    public function twitter() {
        $user = Socialite::with('twitter')->user();
        User::FindOrCreateUserAuth($user, 'twitter');
        return redirect('/smslist/create');
    }


    public function getLogout() {

        Auth::logout();
        return redirect('/');

    }
    public function profile()
    {
        return View::make('account.profile');
    }
    public function balance()
    {
        return View::make('account.balance');
    }

}
