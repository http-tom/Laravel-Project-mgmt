<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the about page.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        return view('about');
    }
}
