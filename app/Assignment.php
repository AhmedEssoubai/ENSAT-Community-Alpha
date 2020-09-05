<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $table = 'assignments';
    public $timestamps = false;
    protected $fillable = ['title', 'objectif', 'deadline', 'course_id', 'all', 'date_publication'];

    /**
     * The course the assignment blongs to
    */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * The assignment professor
     */
    public function professor()
    {
        return $this->hasOneThrough('App\Professor', 'App\Course');
    }

    /**
     * Assignment files
     */
    public function files()
    {
        return $this->morphMany('App\File', 'container');
    }

    /**
     * Get all of the students that are assigned to this assignment.
     */
    public function students()
    {
        return $this->morphedByMany('App\Student', 'assigned');
    }

    /**
     * Get all of the groups that are assigned to this assignment.
     */
    public function groups()
    {
        return $this->morphedByMany('App\Group', 'assigned');
    }

    /**
    *   The assignment submission
    */
    public function submission()
    {
        return $this->hasMany(Submission::class);
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
