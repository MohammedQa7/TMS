<?php

namespace App\Http\Controllers\tenants;


use App\Enums\TaskViewTypes;
use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectValidationRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ProjectController extends Controller
{
    function index()
    {
        $project = Project::with(['users', 'tasks'])->get();
        return Inertia::render('Projects', [
            'projects' => ProjectResource::collection($project)
        ]);
    }

    function store(ProjectValidationRequest $request)
    {

        if ($request->validated()) {
            try {
                DB::beginTransaction();
                $project = Project::create([
                    'user_id' => auth()->id(),
                    'name' => $request->name,
                    'slug' => GlobalHelper::slug_ar($request->name),
                    'description' => $request->description,
                    'budget' => $request->budget,
                    'start_date' => $request->startDate,
                    'end_date' => $request->endDate,
                ]);
                if (sizeof($request->assignedMembers) > 0) {
                    foreach ($request->assignedMembers as $member) {
                        $project->users()->attach($member['id']);
                    }
                }
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
                throw $th;
            }

            if (!$project) {
                abort(404);
            }
        }
    }

    function show(Project $project, Request $request, ProjectService $projectService)
    {



        if (isset($request->viewType) && $request->viewType == TaskViewTypes::LIST ->value) {
            // LIST view (which contain all tasks in a table view)
            $project = $projectService->retrieveTasksOnly($project, $request->viewType, $request->query());
        } else {
            // dd('test');
            // BOARD View (which contain group tasks and tasks in a card way)
            $project = new ProjectResource($project->load([
                'users',
                'groupTasks',
                'groupTasks.tasks' => function ($query) {
                    if ($query) {
                        $query->orderBy('order', 'ASC');
                    }
                },
                'groupTasks.tasks.members',
            ]));
        }


        $task_view_types = collect(TaskViewTypes::cases())->mapWithKeys(function ($value) {
            return [
                $value->name => $value->value
            ];
        });



        return Inertia::render('SingleProject', [
            'project' => $project,
            'taskViewTypes' => $task_view_types,
            'selectedViewType' => match ($request->viewType) {
                TaskViewTypes::LIST ->value => $request->viewType,
                TaskViewTypes::TABLE->value => $request->viewType,
                default => TaskViewTypes::TABLE->value,
            },
        ]);
    }

    function edit()
    {

    }

    function update()
    {

    }

    function delete()
    {

    }

}