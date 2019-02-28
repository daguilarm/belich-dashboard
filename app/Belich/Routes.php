<?php

/*
|--------------------------------------------------------------------------
| Define your coustom routes
|--------------------------------------------------------------------------
*/

/** Belich Routes */
Route::group([
        'as' => Belich::pathName() . '.',
        'middleware' => Belich::middleware(),
    ], function () {

        //Dashboard route
        Route::get(Belich::path(), function() {
            return view('belich::pages.dashboard');
        })->name('dashboard');

        //Maybe, you can create your own controller or view and start the magic!
});
