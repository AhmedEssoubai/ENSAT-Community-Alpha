<?php

namespace App\Http\Controllers;

use App\Course;
use App\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
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
     * Show the list of courses
     *
     */
    public function index($class)
    {
        return view('course.index', ['class' => Classe::with(['courses.professor.user'])->findOrFail($class), 'tab_index' => 2]);
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
            'title' => ['required', 'string', 'max:125'],
            'short_title' => ['required', 'string', 'max:10'],
            'description' => ['required', 'string'],
            'class_id' => 'required',
        ]);
    
        //$id = Auth::user()->profile->id;

        Course::create([
            'title' => $data['title'],
            'short_title' => $data['short_title'],
            'description' => $data['description'],
            'class_id' => $data['class_id'],
            'professor_id' => Auth::user()->profile->id
        ]);
        return redirect()->back();
    }
}
