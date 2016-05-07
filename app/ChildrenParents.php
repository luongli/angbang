<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChildrenParents extends Model
{
    protected $table = 'children_parents';

    protected $fillable = ['id_parent', 'id_child'];
}
