<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request) 
    {
    	$data = $request->validate([
            'name' => 'string|required'
        ]);

    	$beer = \App\Models\Beer::where('name', $request->name)
    					->orWhere('name', 'like', '%' . $request->name . '%')->get();
    					

    	return response($beer, 200);
    }
}
