<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxTestStringController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $results = \App\Test::Query()
            ->select('id as value', 'test_string as label')
            ->when($request->search, function($query) use ($request) {
                return $query->where('test_string', 'like', '%' . $request->search . '%');
            })
            ->take(10)
            ->get();

        return response()->json($results);
    }
}
