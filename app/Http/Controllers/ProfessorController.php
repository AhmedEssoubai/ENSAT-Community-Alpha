<?php

namespace App\Http\Controllers;

use App\Professor;
use App\User;

class ProfessorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('not-pending');
    }

    /**
     * Show all professors
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $professors = Professor::with('user')->get();
        $values = array();
        $ids = array();
        $imgs = array();
        foreach ($professors as $professor) {
            array_push($values, $professor->user->firstname." ".$professor->user->lastname);
            array_push($ids, $professor->id);
            array_push($imgs, $professor->user->image);
        }
        return response()->json(['values' => $values, 'ids' => $ids, 'imgs' => $imgs]);
    }

    /**
     * Search for a professor by first name or last name
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search($value)
    {
        $users = User::where('firstname', 'like', '%'.$value.'%')
                  ->orWhere('lastname', 'like', '%'.$value.'%')
                  ->get(['id', 'firstname', 'lastname', 'image', 'profile_type']);
        $names = array();
        $ids = array();
        $imgs = array();
        foreach ($users as $user) {
            if ($user->profile_type == 'App\Professor')
            {
                array_push($names, $user->firstname." ".$user->lastname);
                array_push($ids, $user->id);
                array_push($imgs, $user->image);
            }
        }
        return response()->json(['names' => $names, 'ids' => $ids, 'imgs' => $imgs]);
    }
}
