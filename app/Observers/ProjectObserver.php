<?php

namespace App\Observers;

use App\Enums\GroupTask;
use App\Models\Project;

class ProjectObserver
{
    /**
     * Handle the Project "created" event.
     */
    public function created(Project $project): void
    {
        collect(GroupTask::cases())->map(function ($value) use ($project) {
            \App\Models\GroupTask::create([
                'title' => $value->value,
                'project_id' => $project->id,
            ]);
        });
    }

    /**
     * Handle the Project "updated" event.
     */
    public function updated(Project $project): void
    {
        //
    }

    /**
     * Handle the Project "deleted" event.
     */
    public function deleted(Project $project): void
    {
        //
    }

    /**
     * Handle the Project "restored" event.
     */
    public function restored(Project $project): void
    {
        //
    }

    /**
     * Handle the Project "force deleted" event.
     */
    public function forceDeleted(Project $project): void
    {
        //
    }
}