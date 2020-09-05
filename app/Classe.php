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
     * The professors of this class
     */
    public function professors()
    {
        return $this->belongsToMany(Professor::class, 'class_professor', 'class_id', 'professor_id');
    }

    /**
     * The students of this class
     */
    public function students()
    {
        return $this->hasMany(Student::class, 'class_id', 'id');
    }

    /**
     * The groups of this class
     */
    public function groups()
    {
        return $this->hasMany(Group::class, 'class_id', 'id');
    }

    /**
     * The courses of this class
     */
    public function courses()
    {
        return $this->hasMany(Course::class, 'class_id', 'id');
    }

    /**
     * Class have many discussions
     */
    public function discussions()
    {
        return $this->hasMany(Discussion::class, 'class_id', 'id')->orderBy('id', 'DESC');
    }

    /**
     * Class have many course resources
     */
    public function resources()
    {
        return $this->hasManyThrough('App\Resource', 'App\Course', 'class_id', 'course_id', 'id', 'id')->orderBy('id', 'DESC');
    }

    /**
     * Class have many course assignments
     */
    public function assignments()
    {
        return $this->hasManyThrough('App\Assignment', 'App\Course', 'class_id', 'course_id', 'id', 'id')->orderBy('id', 'DESC');
    }

    /**
     * The courses of a professor in this class
     */
    public function professor_courses($professor)
    {
        return $this->courses->where('professor_id', $professor);
    }
}
