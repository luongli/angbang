<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassActivity extends Model
{
    //
    protected $table = 'class_activity';

    protected $fillable = [
    	'act_date'
    ];
}
