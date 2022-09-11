<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table='tasks';

    protected $fillable = [
        'title',
        'description',
        'type_of_task',
        'user_id',
        'status',
        'frequency',
        'repetitive_array',
        'time'
    ];

}
