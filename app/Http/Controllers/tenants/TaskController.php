<?php

namespace App\Http\Controllers\tenants;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskUpdateValidationRequest;
use App\Http\Requests\TaskValidationRequest;
use App\Http\Resources\TaskResoruce;
use App\Models\Message;
use App\Models\Project;
use App\Models\Task;
use App\Services\TaskOrderingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class TaskController extends Controller
{

    function index(Request $request)
    {
        $currentProject = Project::where('slug', $request->projectSLUG)->first();
        $tasks = Task::with('groupTask', 'members')
            ->when($request->filter, function ($query) use ($request) {
                $query->where('title', 'LIKE', "%{$request->filter['search']}%");
            })
            ->when($currentProject, function ($query) use ($currentProject) {
                $query->where('project_id', $currentProject->id);
            })
            ->get();
        return response()->json([
            'tasks' => TaskResoruce::collection($tasks),
        ]);
    }


    function store(TaskValidationRequest $request)
    {
        if ($request->validated()) {
            try {
                DB::beginTransaction();
                $project = Project::where('slug', $request->projectSlug)->first();
                $task = Task::create([
                    'project_id' => $project->id,
                    'group_task_id' => $request->groupTaskID,
                    'title' => $request->title,
                    'description' => $request->description ?? null,
                    'priority' => $request->priority['value'],
                    'end_date' => $request->finishDate,
                ]);

                if (is_null($task->order)) {
                    $highest_order = Task::where('group_task_id', $request->groupTaskID)
                        ->where('project_id', $project->id)
                        ->max('order') + 1;

                    $task->update([
                        'order' => $highest_order,
                    ]);
                }

              
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
                throw $th;
            }
        }
    }

    function show(Task $task)
    {

        sleep(1);
        $task->load('members', 'attachments', 'checklists.items', 'chat.messages.user');
        return response()->json([
            'task' => new TaskResoruce($task),
        ]);
    }


    function update(Task $task, TaskUpdateValidationRequest $request)
    {
        if ($request->validated()) {

            try {
                DB::beginTransaction();
                $task->update(array_filter([
                    'title' => $request->title,
                    'description' => $request->description,
                    'priority' => $request->priority,
                    'end_date' => $request->finishDate,
                    'is_completed' => $request->isCompleted,
                ], fn($value) => !is_null($value)));

                if ($request->selectedMembers) {
                    foreach ($request->selectedMembers as $single_member) {
                        $task->members()->attach($single_member['id']);
                    }
                }
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
                throw $th;
            }


        }
    }


    function sendMessage(Request $request)
    {
        $message = Message::create([
            'chat_id' => $request->chat,
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);

        return $message;
    }
}