<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    public $timestamps = true;
    protected $fillable = ['class_id', 'user_id'];

    /**
     * The class of the student
     */
    public function classe()
    {
        return $this->belongsTo(Classe::class, 'class_id', 'id');
    }

    /**
     * The user account of the student
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
