<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $table = 'picture';

    protected $fillable = [ 'url', 'id_class', 'id_post'];
}
