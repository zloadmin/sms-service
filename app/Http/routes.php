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
Route::get('/oauth/facebook', 'AccountController@facebook_redirect');


Route::get('/oauth/callback/github', 'AccountController@github');
Route::get('/oauth/callback/google', 'AccountController@google');
Route::get('/oauth/callback/facebook', 'AccountController@facebook');





Route::group(['middleware' => 'auth'], function () {

    Route::get('/smslist/create', 'SMSListController@create');
    Route::post('/smslist/send', 'SMSListController@send');
    Route::get('/smslist/view/{id}', 'SMSListController@view');
    Route::get('/smslist/download/{id}', 'SMSListController@download');
    Route::post('/smslist/start_send/{id}', 'SMSListController@start_send');
    Route::get('/smslist/list', 'SMSListController@index');
    Route::get('/smslist/list_draft', 'SMSListController@index_draft');

    Route::get('/number_group/list', 'NumbersGroupController@index');
    Route::get('/number_group/system_list', 'NumbersGroupController@systemindex');
    Route::get('/number_group/view/{id}', 'NumbersGroupController@view');
    Route::get('/number_group/system_view/{id}', 'NumbersGroupController@system_view');
    Route::get('/number_group/create', 'NumbersGroupController@create');
    Route::post('/number_group/send', 'NumbersGroupController@send');
    Route::delete('/number_group/delete/{id}', 'NumbersGroupController@delete');
    Route::post('/number_group/download/{id}', 'NumbersGroupController@download');

    Route::get('/number_group/change_users', 'NumbersGroupController@change_users');
    Route::get('/number_group/change_system', 'NumbersGroupController@change_system');

    Route::get('/number_group/ajax/add_or_remove_group/{id}', 'NumbersGroupController@ajax_add_or_remove_group');
    Route::get('/number_group/remove_all_group', 'NumbersGroupController@remove_all_group');

//    Route::get('/number_group/sessiontest', 'NumbersGroupController@sessiontest');

});


Route::any('foo', function () {
    return 'Hello World';
});

