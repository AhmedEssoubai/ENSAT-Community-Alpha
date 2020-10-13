<?php

namespace App\Http\Controllers;

use App\User;
use App\Professor;
use App\Student;
use Illuminate\Http\Request;

class AdminController extends Controller
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
        //$this->middleware('admin');
    }

    /**
     * Accept a user
     *
     * @param  array  $data
     * @return \App\Groupe
     */
    public function accept_user(User $user)
    {
        $user->update(['status' => 'membre']);
        
        return redirect()->back();
    }

    /**
     * Delete a user
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy_user(User $user)
    {
        //$this->authorize('delete', $user);
        $user->profile->delete();

        $user->delete();
        
        return redirect()->back();
    }

    /**
     * Show the list of professors
     */
    public function professors()
    {
        return view('admin.users', 
        ['pending' => User::where('profile_type', 'App\Professor')->where('status', 'pending')->orderBy('id', 'DESC')->get(), 
        'members' => User::where('profile_type', 'App\Professor')->where('status', 'membre')->orderBy('id', 'DESC')->get(), 
        'user_tab_index' => 1]);
    }

    /**
     * Show the list of students
     */
    public function students()
    {
        return view('admin.users', 
        ['pending' => User::where('profile_type', 'App\Student')->where('status', 'pending')->with('profile')->orderBy('id', 'DESC')->get(), 
        'members' => User::where('profile_type', 'App\Student')->where('status', 'membre')->with('profile')->orderBy('id', 'DESC')->get(), 
        'user_tab_index' => 0]);
        /*['pending' => Student::leftJoin('users', 'students.user_id', '=', 'users.id')->where('users.status', 'pending')->with('user')->orderBy('students.id', 'DESC')->get(), 
        'members' => Student::leftJoin('users', 'students.user_id', '=', 'users.id')->where('users.status', 'membre')->with('user')->orderBy('students.id', 'DESC')->get(), 
        'user_tab_index' => 0]);*/
        /*return view('admin.students', 
        ['pending' => Student::with('user')->where('users->status', 'pending')->orderBy('id', 'DESC')->get(), 
        'members' => Student::with('user')->where('users->status', '<>', 'pending')->orderBy('id', 'DESC')->get(), 
        'user_tab_index' => 0]);*/
    }
}
