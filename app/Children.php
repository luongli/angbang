<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    protected $table = 'children';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'mname', 'lname', 'birthday', 'sex', 'address', 'mood', 'health', 'temperature', 'sleep', 'food'
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'secret_token',
    ];

    /**
     * Get the class that the child enrolls in
     */
    public function get_class()
    {
        return $this->belongsTo('App\Classes', 'id_class');
    }

    /**
     * A child may have more than 1 parent
     */
    public function parents()
    {
        return $this->belongsToMany('App\User', 'children_parents', 'id_child', 'id_parent');
    }

    /**
     * A child may have more than 1 parent
     * return only id of parents
     */
    public function id_parents()
    {
        return $this->belongsToMany('App\User', 'children_parents', 'id_child', 'id_parent')->select('id');
    }
}
