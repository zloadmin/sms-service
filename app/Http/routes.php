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