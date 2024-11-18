<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checklists extends Model
{

    protected $guarded = [
        'id',
        'created_at',
    ];


    // RELATIONSHIPS
    function tasks()
    {
        return $this->belongsTo(Task::class);
    }

    function items()
    {
        return $this->hasMany(Checkitem::class);
    }
}