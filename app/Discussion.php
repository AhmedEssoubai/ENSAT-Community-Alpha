<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Discussion extends Model
{
    protected $table = 'discussions';
    public $timestamps = false;
    protected $fillable = ['title', 'content', 'image', 'user_id', 'class_id', 'course_id', 'date_publication'];

    /**
     * The class the discussion have
     */
    public function class()
    {
        return $this->belongsTo(Classe::class, 'class_id', 'id');
    }

    /**
     * The post can be published by one user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function favorited_users()
    {
        return $this->belongsToMany(User::class, 'favorises', 'discussion_id', 'user_id');
    }

    public function bookmarked_users()
    {
        return $this->belongsToMany(User::class, 'bookmarks', 'discussion_id', 'user_id');
    }

    public function is_liked()
    {
        return !empty($this->favorited_users()->find(Auth::id()));
    }

    public function is_bookmarked()
    {
        return !empty($this->bookmarked_users()->find(Auth::id()));
    }

    public function can_delete(User $user)
    {
        return true;
    }

    public function can_edit(User $user)
    {
        return $user->id == $this->user->id;
    }
}
