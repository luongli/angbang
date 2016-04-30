<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActComment extends Model
{
    //
    protected $table = 'act_comment';

    protected $fillable = ['content', 'time'];
}
