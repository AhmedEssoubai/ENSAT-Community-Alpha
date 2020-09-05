<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $table = 'submissions';
    public $timestamps = false;
    protected $fillable = ['url'];

    /**
     * The assignment the submission submit for
     */
    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    /**
    *   The submission submitter
    */
    public function submitter()
    {
        return $this->morphTo();
    }

    /**
     * Assignment files
     */
    public function files()
    {
        return $this->morphMany('App\File', 'container');
    }
}
