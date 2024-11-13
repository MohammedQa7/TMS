<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PHPStan\PhpDocParser\Ast\PhpDoc\ReturnTagValueNode;

class Project extends Model
{
    protected $guarded = [
        'id',
        'created_at',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    function users()
    {
        return $this->belongsToMany(User::class, 'project_users');
    }

    function groupTasks()
    {
        return $this->hasMany(GroupTask::class);
    }

    function tasks()
    {
        return $this->hasMany(Task::class);
    }


    public function calculateTasksCompletedPercentage()
    {
        $all_tasks = $this->tasks->count();
        $completed_tasks = $this->tasks->where('is_completed', true)->count();
        if ($completed_tasks != 0) {
            $percentage = round(($completed_tasks / $all_tasks) * 100, 1);
            return $percentage;
        }
        return 0.0;
    }
}