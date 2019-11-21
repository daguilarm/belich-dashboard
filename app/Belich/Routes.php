<?php

/*
|--------------------------------------------------------------------------
| Define your coustom routes
|--------------------------------------------------------------------------
*/

// Dashboard / Home route
Route::get(Belich::path(), '\App\Belich\Dashboard');

// Testing routes
Route::get(Belich::path() . '/ajax/user', '\App\Http\Controllers\AjaxUserController')
    ->name('ajax.user');
Route::get(Belich::path() . '/ajax/test/name', '\App\Http\Controllers\AjaxTestNameController')
    ->name('ajax.test.name');
Route::get(Belich::path() . '/ajax/test/string', '\App\Http\Controllers\AjaxTestStringController')
    ->name('ajax.test.string');

// Testing custom route
Route::resource(Belich::path() . '/testing/', '\App\Http\Controllers\TestController');
