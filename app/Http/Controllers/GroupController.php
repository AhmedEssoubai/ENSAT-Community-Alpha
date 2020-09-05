<?php

namespace App\Http\Controllers;

use App\Classe;
use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GroupController extends Controller
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
     * Show the list of groups for a class
     *
     */
    public function index($class)
    {
        return view('group.index', ['class' => Classe::with(['groups.students.user'])->findOrFail($class), 'tab_index' => 3]);
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
            'class' => 'required',
            'students' => 'required'
        ]);
        $g = Group::create([
            'label' => $data['label'],
            'class_id' => $data['class']
        ]);
        if (is_array($data['students']))
            foreach($data['students'] as $student)
                $g->students()->attach($student);
        else
            $g->students()->attach($data['students']);
        //}
        return redirect()->back();
    }
}
