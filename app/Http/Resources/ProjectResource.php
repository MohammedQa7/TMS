<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => Str::limit($this->description, 30),
            'budget' => $this->budget,
            'completePercentage' => $this->whenLoaded('tasks', function () {
                return $this->calculateTasksCompletedPercentage();
            }),
            'owner' => $this->user_id,
            'members' => $request->routeIs('projects.index') ? count($this->whenLoaded('users')) : UserResource::collection($this->whenLoaded('users')),
            'groupTasks' => $request->routeIs('projects.show') ? GroupTaskResource::collection($this->whenLoaded('groupTasks')) : null,
            'startDate' => Carbon::createFromFormat('d/m/Y', $this->start_date),
            'endDate' => Carbon::createFromFormat('d/m/Y', $this->end_date),
        ];
    }

}