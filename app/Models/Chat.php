<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $guarder = [
        'id',
        'created_at'
    ];


    function task()
    {
        return $this->belongsTo(Task::class);
    }

    function messages()
    {
        return $this->hasMany(Message::class);
    }
}