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

//Ajax route
Route::get(Belich::path() . '/ajax/example', '\App\Http\Controllers\AjaxController')
    ->name('ajax.example');
