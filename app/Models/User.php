<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use LDAP\ResultEntry;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles ;

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

    // CUSTOM ROLES AND PERMISSIONS HANDLING FOR SPECIFIC PROJECT
    public function assignRoleWithProject($role_name, $project_id = null)
    {
        $role = Role::where('name', $role_name)->firstOrFail();

        $this->roles()->attach($role->id, ['project_id' => $project_id]);
    }
    public function revokeRoleWithProject($role_name, $project_id = null)
    {
        $role = Role::where('name', $role_name)->firstOrFail();
        $this->roles()
            ->when(!is_null($project_id), function ($query) use ($project_id) {
                $query->wherePivot('project_id', $project_id);
            })
            ->detach($role->id);
    }
    public function canForProject($permissions, $project_id)
    {
        return $this->roles()
            ->wherePivot('project_id', $project_id) // Use the passed project_id
            ->whereHas('permissions', function ($query) use ($permissions) {
                $query->when(is_array($permissions), function ($query) use ($permissions) {
                    $query->whereIn('name', $permissions);
                });
                $query->when(is_string($permissions), function ($query) use ($permissions) {
                    $query->where('name', $permissions);
                });
            })
            ->exists();
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
        return $query->whereDoesntHave('tasks', function ($query) use ($task_id) {
            return $query->where('task_id', $task_id);
        });

    }
}