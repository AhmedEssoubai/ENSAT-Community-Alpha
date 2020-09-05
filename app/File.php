<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';
    public $timestamps = false;
    protected $fillable = ['url', 'name'];

    /**
    *   The file container
    */
    public function container()
    {
        return $this->morphTo();
    }

    /**
     * Get file name
     */
    /*public function file_name()
    {
        $parts = explode("/", $this->url);
        return $parts[count($parts) - 1];
    }*/
}
