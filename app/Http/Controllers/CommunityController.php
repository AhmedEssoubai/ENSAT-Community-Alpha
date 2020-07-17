<?php

namespace App\Http\Controllers;

use App\Classe;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('pending');
    }

    /**
     * Show a community
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($class)
    {
        return view('community.show', ['class' => Classe::findOrFail($class)]);
    }
}
