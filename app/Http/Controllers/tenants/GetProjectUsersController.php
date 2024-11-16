<?php

namespace App\Http\Controllers\tenants;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Project;
use App\Models\User;
use App\Services\PriorityService;
use Illuminate\Http\Request;

class GetProjectUsersController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, PriorityService $priorityService)
    {
        sleep(1);
        $project = Project::where('slug', $request->projectSlug)->first();
        if ($project) {
            $users = User::
                getProjectUsers($project)
                ->with('tasks')
                ->when($request->taskID, function ($query) use ($request) {
                    $query->getUsersWithoutTasks($request->taskID);
                })
                ->get();
            return response()->json([
                'members' => UserResource::collection($users),
                'priorities' => isset($request->withPriority) && $request->withPriority == false ? null : $priorityService->retrievePriorities(),
            ]);
        }
    }
}