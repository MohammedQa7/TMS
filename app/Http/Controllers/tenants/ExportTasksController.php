<?php

namespace App\Http\Controllers\tenants;

use App\Exports\TaskExport;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportTasksController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Project $project)
    {
        return Excel::download(new TaskExport($project), $project->slug. '.xlsx');

    }
}