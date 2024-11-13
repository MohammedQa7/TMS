<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupTask extends Model
{
    protected $guarded = [
        'id',
        'created_at'
    ];


    function project()
    {
        return $this->belongsTo(Project::class);
    }

    function tasks()
    {
        return $this->hasMany(Task::class, 'group_task_id');
    }
}