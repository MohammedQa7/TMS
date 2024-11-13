<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use LDAP\ResultEntry;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    // RELATIONSHIPS
    function projects()
    {
        return $this->belongsToMany(Project::class, 'project_users');
    }

    function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_users');
    }

    // SCOPES

    function scopegetProjectUsers($query, $project)
    {
        return $query->whereHas('projects', function ($query) use ($project) {
            return $query->where('project_id', $project->id);
        })
            ->whereNot('id', auth()->id());
    }

    function scopegetTaskUsers($query, $task)
    {
        return $query->whereHas('tasks', function ($query) use ($task) {
            return $query->where('task_id', $task->id);
        })
            ->whereNot('id', auth()->id());
    }
    function scopegetUsersWithoutTasks($query, $task_id)
    {
        return $query->whereHas('tasks', function ($query) use ($task_id) {
            $query->whereNot('task_id', $task_id);
        });
    }
}