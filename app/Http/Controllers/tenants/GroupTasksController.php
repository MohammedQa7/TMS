<?php

namespace App\Http\Controllers\tenants;

use App\Http\Controllers\Controller;
use App\Http\Resources\GroupTaskResource;
use App\Models\GroupTask;
use App\Models\Task;
use App\Services\TaskOrderingService;
use Illuminate\Http\Request;

class GroupTasksController extends Controller
{

    function update($groupTask, Request $request, TaskOrderingService $taskOrderingService)
    {
        $new_group = GroupTask::where('id', $request->newGroup)->first();
        if ($new_group) {

            $taskOrderingService->changeTaskOrderAndGroupTask($request->newOrder, $new_group, $request->draggedElement);
            
        } else if ($groupTask) {
            if ($request->newOrder) {
                $taskOrderingService->changeTaskOrder($request->newOrder);
            } else {
                $update_group = GroupTask::where('id', $groupTask)->firstOrFail();
                $update_group->update([
                    'title' => $request->data['title'],
                ]);

                return response()->json([
                    'data' => new GroupTaskResource($update_group),
                ]);
            }


        }
    }
}