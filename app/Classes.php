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
}
