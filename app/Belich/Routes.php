<?php

/*
|--------------------------------------------------------------------------
| Define your coustom routes
|--------------------------------------------------------------------------
*/

//Dashboard route
Route::get(Belich::path(), function() {
    return view('belich::pages.dashboard');
});

//Ajax routes
Route::get(Belich::path() . '/ajax/user', '\App\Http\Controllers\AjaxUserController')
    ->name('ajax.user');
Route::get(Belich::path() . '/ajax/test/name', '\App\Http\Controllers\AjaxTestNameController')
    ->name('ajax.test.name');
Route::get(Belich::path() . '/ajax/test/string', '\App\Http\Controllers\AjaxTestStringController')
    ->name('ajax.test.string');
