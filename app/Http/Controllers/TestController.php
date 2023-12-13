<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function index(Request $request)
    {
        //dd($request);
        return view('test');
    }
    public function contrib(Request $request)
    {
        //dd($request);
        return view('contrib');
    }
}
