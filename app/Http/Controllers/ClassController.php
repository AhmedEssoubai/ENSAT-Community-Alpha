<?php

namespace App\Http\Controllers;

use App\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
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
     * Show the list of classes
     *
     */
    public function index()
    {
        return view('class.index', ['classes' => Classe::get()]);
    }

    /**
     * Create a new group instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Groupe
     */
    public function store()
    {
        $data = request()->validate([
            'label' => ['required', 'string', 'max:255'],
            'chef' => 'required'
        ]);
        $c = Classe::create([
            'label' => $data['label'],
            'chef_id' => $data['chef'],
            'image' => '/img/class-cover.jpg'
        ]);
        return redirect()->route('community.show', ['class' => $c->id]);
    }

    /**
     * Show a class
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($class)
    {
        return view('class.show', ['class' => Classe::findOrFail($class)]);
    }

    /**
     * Show a create class form
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('class.create');
    }
}
