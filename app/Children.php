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
        return $this->belongsTo('App\Class', 'id_class');
    }
}
