<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $table = 'classes';
    public $timestamps = true;
    protected $fillable = ['label', 'chef_id', 'image'];

    /**
     * Class has chef
     */
    public function chef()
    {
        return $this->belongsTo(Professor::class, 'chef_id', 'id');
    }

    /**
     * The students of this class
     */
    public function students()
    {
        return $this->hasMany(Student::class, 'class_id', 'id');
    }
}
