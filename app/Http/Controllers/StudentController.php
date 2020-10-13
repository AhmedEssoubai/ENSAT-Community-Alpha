<?php

namespace App\Http\Controllers;

use App\User;
use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
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
     * Search for a student by first name or last name
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search($value)
    {
        $users = User::where('firstname', 'like', '%'.$value.'%')
                  ->orWhere('lastname', 'like', '%'.$value.'%')
                  ->get(['id', 'firstname', 'lastname', 'image', 'profile_id', 'profile_type']);
        $names = array();
        $ids = array();
        $imgs = array();
        foreach ($users as $user) {
            if ($user->profile_type == 'App\Student')
            {
                array_push($names, $user->firstname." ".$user->lastname);
                array_push($ids, $user->profile_id);
                array_push($imgs, $user->image);
            }
        }
        return response()->json(['names' => $names, 'ids' => $ids, 'imgs' => $imgs]);
    }
}
