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

    Route::get('/smslist/create', 'SMSListController@create');
    Route::post('/smslist/send', 'SMSListController@send');

    Route::get('/number_group/list', 'NumbersGroupController@index');
    Route::get('/number_group/system_list', 'NumbersGroupController@systemindex');
    Route::get('/number_group/view/{id}', 'NumbersGroupController@view');
    Route::get('/number_group/system_view/{id}', 'NumbersGroupController@system_view');
    Route::get('/number_group/create', 'NumbersGroupController@create');
    Route::post('/number_group/send', 'NumbersGroupController@send');
    Route::delete('/number_group/delete/{id}', 'NumbersGroupController@delete');
    Route::post('/number_group/download/{id}', 'NumbersGroupController@download');
    Route::get('/number_group/change', 'NumbersGroupController@change');

    Route::get('/number_group/ajax/add_group/{id}', 'NumbersGroupController@ajax_add_group');

});


Route::any('foo', function () {
    return 'Hello World';
});

