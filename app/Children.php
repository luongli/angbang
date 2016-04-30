<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    protected $table = 'childrens';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname', 'email', 'password', 'birthday', 'sex', 'address', 'phone', 'type'
    ];

    protected $dates = ['deleted_at', 'last_login'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
