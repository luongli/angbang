<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'mname', 'lname', 'email', 'password', 'birthday', 'sex', 'address', 'phone', 'type', 'avatar'
    ];

    protected $dates = ['deleted_at', 'last_login'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'avatar',
    ];

    /**
     * Classes that teacher is working on
     */
    public function classes()
    {
        return $this->belongsToMany('App\Classes', 'teacher_class', 'id_teacher', 'id_class');
    }

    /**
     * A parent may have more than one child
     */
    public function children()
    {
        return $this->belongsToMany('App\Children', 'children_parents', 'id_parent', 'id_child');
    }
}


