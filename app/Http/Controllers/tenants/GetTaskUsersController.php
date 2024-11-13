<?php

namespace App\Http\Controllers\tenants;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class GetTaskUsersController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        sleep(1);
        $task = Task::where('id', $request->taskID)->first();
        if ($task) {
            $users = User::
                getTaskUsers($task)
                ->get();
            return response()->json([
                'currentMembers' => UserResource::collection($users),
            ]);
        }
    }
}