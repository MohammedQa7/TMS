<?php

namespace App\Http\Controllers\tenants;

use App\Http\Controllers\Controller;
use App\Http\Resources\CheckitemResource;
use App\Models\Checkitem;
use Illuminate\Http\Request;

class ChecklistItemsController extends Controller
{
    function store(Request $request)
    {

        $checkitem = Checkitem::create([
            'checklists_id' => $request->checklistID,
            'title' => $request->title,
        ]);
        if ($checkitem) {
            return response()->json(new CheckitemResource($checkitem), );
        }
    }


    function update(Checkitem $item, Request $request)
    {

        $item->update(array_filter([
            'title' => $request->item['title'],
            'is_completed' => $request->item['isCompleted'],
        ], fn($value) => !is_null($value)));
    }
}