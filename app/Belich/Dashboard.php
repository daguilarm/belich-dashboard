<?php

namespace App\Belich;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class Dashboard extends Controller
{
    /**
     * Create a Dashboard/Home controller instance.
     *
     * @return Illuminate\Support\Facades\View
     */
    public function __invoke(): View
    {
        return view('belich::dashboard');
    }
}
