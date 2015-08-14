<?php

// index page
Route::get('/', function () {
    return view('index');
});

//set lang
Route::get('setlocale/{locale}', function ($locale) {

    if (in_array($locale, \Config::get('app.locales'))) Session::put('locale', $locale);

    return redirect()->back();

});


Route::get('/oauth/logout', 'AccountController@getLogout');



Route::get('/oauth/github', 'AccountController@github_redirect');
Route::get('/oauth/google', 'AccountController@google_redirect');



Route::get('/oauth/callback/github', 'AccountController@github');
Route::get('/oauth/callback/google', 'AccountController@google');






Route::group(['middleware' => 'auth'], function () {

    //for users

});