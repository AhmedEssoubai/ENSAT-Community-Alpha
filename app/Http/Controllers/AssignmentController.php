<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\File;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
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
     * Show a discussions
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Classe $class)
    {
        return view('assignment.index', ['class' => $class, 'prof_courses' => $class->professor_courses(Auth::user()->profile->id), 'sub_tab_index' => 2]);
    }

    
    /**
     * Create a new assignment instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\assignment
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'title' => ['required', 'string', 'max:125'],
            'objectif' => ['required', 'string'],
            'deadline' => ['required', 'date'],
            'course' => 'required'
        ]);

        $assignment = Assignment::create([
            'title' => $data['title'],
            'objectif' => $data['objectif'],
            'deadline' => $data['deadline'],
            'course_id' => $data['course']
        ]);

        $attachments = $request->file('attachments');

        if (is_array($attachments) || is_object($attachments))
        {
            Storage::makeDirectory('upload/assignment');
            foreach($attachments as $attachment)
            {
                $file = $attachment->getClientOriginalName();
                $name = pathinfo($file, PATHINFO_FILENAME) . '.' . pathinfo($file, PATHINFO_EXTENSION);
                $path = $attachment->store('uploads/assignment', 'public');
                $parts = explode("/", $path);
                $assignment->files()->create([
                    'url' => $parts[count($parts) - 1],
                    'name' => $name
                ]);
            }
        }
        return redirect()->back();
    }

    /**
     * Show an assignment
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Assignment $assignment)
    {
        return view('assignment.show', ['assignment' => $assignment, 'user' => Auth::id(), 'class' => $assignment->course->classe]);
    }

    /**
     * Show the edit assignment form
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Assignment $assignment)
    {
        //$this->authorize('update', $assignment);

        return view('assignment.edit', ['assignment' => $assignment]);
    }

    /**
     * Update a assignment
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Assignment $assignment)
    {
        //$this->authorize('update', $assignment);

        $data = request()->validate([
            'titre' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image' => ['image']
        ]);

        if (!empty($data['image']))
        {
            Storage::delete($assignment->image);
            $image = ['image' => ($data['image']->store('uploads', 'public'))];
        }

        $assignment->update(array_merge($data, $image ?? []));
        
        return redirect()->route('assignment.show', ['assignment' => $assignment]);
    }

    /**
     * Delete a assignment
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy(Assignment $assignment)
    {
        //$this->authorize('delete', $assignment);

        $id = $assignment->class_id;

        $assignment->delete();
        
        return redirect('/classes/' . $id);
    }
}
