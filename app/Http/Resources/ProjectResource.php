<?php

namespace App\Http\Resources;

use App\Enums\TaskViewTypes;
use App\Models\Project;
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
        $additionalData = $this->additional;
        $resourceArray = [
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

        // Append any new data to the resource array 
        if (isset($additionalData['view_type']) && $additionalData['view_type'] == TaskViewTypes::LIST ->value) {
            unset($additionalData['filter']['viewType']);

            // Loading the tasks relationship from project then appending the query string using appends() so we can get all the query string while we navigate from one page to another
            $tasks = $this->tasks()
                ->when(isset($additionalData['filter']['search']), function ($query) use ($additionalData) {
                    $query->where('title', 'LIKE', "%{$additionalData['filter']['search']}%");
                })
                ->paginate(1)
                ->appends(request()->query());


            $resourceArray['tasks'] = TaskResoruce::collection($tasks)->response()->getData(true); // Add the key-value pair directly
        }


        return $resourceArray;






        // return [
        //     'name' => $this->name,
        //     'slug' => $this->slug,
        //     'description' => Str::limit($this->description, 30),
        //     'budget' => $this->budget,
        //     'completePercentage' => $this->whenLoaded('tasks', function () {
        //         return $this->calculateTasksCompletedPercentage();
        //     }),
        //     'owner' => $this->user_id,
        //     'members' => $request->routeIs('projects.index') ? count($this->whenLoaded('users')) : UserResource::collection($this->whenLoaded('users')),
        //     'groupTasks' => $request->routeIs('projects.show') ? GroupTaskResource::collection($this->whenLoaded('groupTasks')) : null,
        //     'tasks' => TaskResoruce::collection($tasks->items()),
        //     'pagination' => [
        //         'current_page' => $tasks->currentPage(),
        //         'total_pages' => $tasks->lastPage(),
        //         'per_page' => $tasks->perPage(),
        //         'total_items' => $tasks->total(),
        //         'next_page_url' => $tasks->nextPageUrl(),
        //         'prev_page_url' => $tasks->previousPageUrl(),
        //     ],
        //     'startDate' => Carbon::createFromFormat('d/m/Y', $this->start_date),
        //     'endDate' => Carbon::createFromFormat('d/m/Y', $this->end_date),
        // ];
    }

}