<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [
        'id',
        'created_at',
    ];


    // RELATIONSHIPS
    function groupTask()
    {
        return $this->belongsTo(GroupTask::class, 'group_task_id');
    }


    function project()
    {
        return $this->belongsTo(Project::class);
    }

    function members()
    {
        return $this->belongsToMany(User::class, 'task_users');
    }

    function chat()
    {
        return $this->hasOne(Chat::class);
    }


    // SCOPES

    function scopeFilter($query, $filter)
    {
        return $query->where('title', 'LIKE', '%' . $filter . '%');
    }



}