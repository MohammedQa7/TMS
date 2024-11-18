<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class TaskResoruce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        if ($request->routeIs('projects.index')) {
            return [
                'id' => $this->id,
                'isCompleted' => $this->is_completed,
            ];
        } else {
            return [
                'id' => $this->id,
                'project_id' => $this->project_id,
                'groupTaskID' => $this->group_task_id,
                'title' => $this->title,
                'description' => $this->description,
                'priority' => $this->priority,
                'finishDate' => $this->end_date,
                'order' => $this->order,
                'createdAt' => $this->created_at->format('d/m/Y'),
                'lastUpdated' => $this->updated_at->format('d/m/Y'),
                'deadline' => $this->end_date ?? null,
                'isCompleted' => $this->is_completed,
                'groupTask' => new GroupTaskResource($this->whenLoaded('groupTask')),
                'checklists' => ChecklistResource::collection($this->whenLoaded('checklists')),
                'chat' => new ChatResource($this->whenLoaded('chat')),
                'members' => $this->whenLoaded('members', function () {
                    return collect(UserResource::collection($this->whenLoaded('members')))->take(3);
                }),
                'membersCount' => $this->whenLoaded('members', function () {
                    return collect(UserResource::collection($this->whenLoaded('members')))->skip(2)->count() ?? null;
                }),
            ];
        }
    }
}