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
    public function __invoke(Task $task)
    {

        sleep(1);
        $users = User::
            getUsersWithoutTasks($task->id)
            ->get();
        return response()->json([
            'currentMembers' => UserResource::collection($users),
        ]);
    }
}