<?php

namespace App\Http\Controllers\tenants;

use App\Http\Controllers\Controller;
use App\Http\Resources\CheckitemResource;
use App\Http\Resources\ChecklistResource;
use App\Models\Checkitem;
use App\Models\Checklists;
use Illuminate\Http\Request;

class TaskChecklistController extends Controller
{

    function store(Request $request)
    {

        $checklists = Checklists::create([
            'task_id' => $request->taskID,
            'title' => $request->title,
        ]);

        if ($checklists) {
            return response()->json(new ChecklistResource($checklists), );
        }
    }

  
}