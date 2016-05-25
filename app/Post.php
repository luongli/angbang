<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status', 'id_user'
    ];

    protected $hidden = [
        'updated_at'
    ];

    public function comments() {
        return $this->hasMany('App\PostComment', 'id_post');
    }

    public function picture() {
        return $this->hasMany('App\Picture', 'id_post');
    }
}
