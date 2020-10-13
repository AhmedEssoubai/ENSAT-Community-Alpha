<?php

namespace App\Http\Controllers;

use App\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Discussion;
use Illuminate\Support\Facades\Storage;

class DiscussionController extends Controller
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
    public function index($class)
    {
        return view('discussion.index', ['class' => Classe::findOrFail($class), 'sub_tab_index' => 0]);
    }

    
    /**
     * Create a new discussion instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Discussion
     */
    public function store()
    {
        $data = request()->validate([
            'class' => 'required',
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image' => ['image']
        ]);

        $path = null;

        if (!empty($data['image']))
            $path = $data['image']->store('uploads', 'public');

        $id = Auth::id();

        Discussion::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'class_id' => $data['class'],
            'image' => $path,
            'user_id' => $id
        ]);
        
        return redirect()->back();

        //return redirect()->route('groupes.show', ['groupe' => $data['groupe_id']]);
    }

    /**
     * Show a discussion
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($discussion)
    {
        return view('discussion.show', ['discussion' => Discussion::findOrFail($discussion), 'user' => Auth::id(), 'class' => $discussion->course->classe]);
    }

    /**
     * Favorite a discussion or remove favorite from him if already exists
     */
    public function favorite(Discussion $discussion)
    {
        return $discussion->favorited_users()->toggle(Auth::user());
        
        //return response()->json(['message' => 'Not a member'], 200);
    }

    /**
     * Bookmark a discussion or remove it from bookmark list if already exists
     */
    public function bookmark(Discussion $discussion)
    {
        return $discussion->bookmarked_users()->toggle(Auth::user());
    }

    /**
     * Show the edit discussion form
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Discussion $discussion)
    {
        //$this->authorize('update', $post);

        return view('discussion.edit', ['discussion' => $discussion]);
    }

    /**
     * Update a discussion
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Discussion $discussion)
    {
        //$this->authorize('update', $post);

        $data = request()->validate([
            'titre' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image' => ['image']
        ]);

        if (!empty($data['image']))
        {
            Storage::delete($discussion->image);
            $image = ['image' => ($data['image']->store('uploads', 'public'))];
        }

        $discussion->update(array_merge($data, $image ?? []));
        
        return redirect()->route('discussions.show', ['discussion' => $discussion]);
    }

    /**
     * Delete a discussion
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy(Discussion $discussion)
    {
        //$this->authorize('delete', $discussion);

        $id = $discussion->class_id;

        $discussion->delete();
        
        return redirect('/classes/' . $id);
    }
}
