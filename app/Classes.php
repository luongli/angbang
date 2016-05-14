<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table = 'class';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'class_name', 'course', 'num_of_student'
    ];

    /**
     * Get the children in the class
     */
    public function children()
    {
    	return $this->hasMany('App\Children', 'id_class');
    }

    /**
     * Teachers who are working on a class
     */
    public function teachers()
    {
        return $this->belongsToMany('App\User', 'teacher_class', 'id_class', 'id_teacher');
    }


    /**
     * get id of teachers who are working on a class
     */
    public function id_teachers()
    {
        return $this->belongsToMany('App\User', 'teacher_class', 'id_class', 'id_teacher')->select('id');
    }
}
