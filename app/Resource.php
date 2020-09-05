<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Resource extends Model
{
    protected $table = 'resources';
    public $timestamps = false;
    protected $fillable = ['title', 'content', 'course_id', 'date_publication'];

    /**
     * The course the resource blongs to
    */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * The resource professor
     */
    public function professor()
    {
        return $this->hasOneThrough('App\Professor', 'App\Course');
    }

    /**
     * Resource files
     */
    public function files()
    {
        return $this->morphMany('App\File', 'container');
    }

    public function can_delete(User $user)
    {
        return true;
    }

    public function can_edit(User $user)
    {
        return true;
    }
}
