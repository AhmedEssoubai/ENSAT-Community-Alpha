<?php

namespace App\Http\Controllers;

use App\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Resource;
use App\File;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
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
        return view('resource.index', ['class' => $class, 'prof_courses' => $class->professor_courses(Auth::user()->profile->id), 'sub_tab_index' => 1]);
    }

    
    /**
     * Create a new resource instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Resource
     */
    public function store(Request $request)
    {
        $title = $request->input('title');
        $content = $request->input('content');
        $course = $request->input('course');
        $attachments = $request->file('attachments');
        /*$data = request()->validate([
            'title' => ['required', 'string', 'max:125'],
            'content' => ['required', 'string'],
            'course' => 'required',
            'attachments' => 'required'
        ]);*/

        $resource = Resource::create([
            'title' => $title,
            'content' => $content,
            'course_id' => $course
        ]);

        if (is_array($attachments) || is_object($attachments))
        {
            Storage::makeDirectory('upload/resources');
            foreach($attachments as $attachment)
            {
                $file = $attachment->getClientOriginalName();
                $name = pathinfo($file, PATHINFO_FILENAME) . '.' . pathinfo($file, PATHINFO_EXTENSION);
                $path = $attachment->store('uploads/resources', 'public');
                $parts = explode("/", $path);
                $resource->files()->create([
                    'url' => $parts[count($parts) - 1],
                    'name' => $name
                ]);
            }
        }
        return redirect()->back();
    }

    /**
     * Show a resource
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Resource $resource)
    {
        return view('resource.show', ['resource' => $resource, 'user' => Auth::id(), 'class' => $resource->course->classe]);
    }

    /**
     * Show the edit resource form
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Resource $resource)
    {
        //$this->authorize('update', $post);

        return view('resource.edit', ['resource' => $resource]);
    }

    /**
     * Update a resource
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Resource $resource)
    {
        //$this->authorize('update', $post);

        $data = request()->validate([
            'titre' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image' => ['image']
        ]);

        if (!empty($data['image']))
        {
            Storage::delete($resource->image);
            $image = ['image' => ($data['image']->store('uploads', 'public'))];
        }

        $resource->update(array_merge($data, $image ?? []));
        
        return redirect()->route('resource.show', ['resource' => $resource]);
    }

    /**
     * Delete a resource
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy(Resource $resource)
    {
        //$this->authorize('delete', $discussion);

        $id = $resource->class_id;

        $resource->delete();
        
        return redirect('/classes/' . $id);
    }
}
