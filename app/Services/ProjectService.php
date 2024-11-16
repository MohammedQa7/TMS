<?php

namespace App\Services;

use App\Http\Resources\ProjectResource;
use App\Http\Resources\TaskResoruce;

class ProjectService
{
    function retrieveTasksOnly($current_project, $view_type, $filter = null)
    {
        $project = new ProjectResource($current_project->load(['users']));

        return $project->additional(['view_type' => $view_type, 'filter' => $filter]);
    }

}