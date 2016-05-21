<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notification';

    protected $fillable = [ 'type', 'description', 'id_action', 'sender', 'class_id' ];
}
