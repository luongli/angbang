<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuComment extends Model
{
    protected $table = 'menu_comment';

    protected $fillable = [ 'content' ];
}
