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
        //Maybe, you can create your own controller or view and start the magic!
        Route::get(Belich::path(), function() {
            return view('belich::pages.dashboard');
        })->name('dashboard');

});
