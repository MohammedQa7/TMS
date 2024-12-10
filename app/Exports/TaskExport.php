<?php
namespace App\Exports;

use App\Models\Project;
use App\Models\Task;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;


class TaskExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    //  public Project $project
    public $task_headings;
    public $tasks;

    function __construct(public Project $project)
    {
        $this->tasks = Task::with('members', 'project')->get()->where('project_id', $project->id)->map(function ($task) {
            return [
                'id' => $task->id,
                'Title' => $task->title,
                'Description' => $task->description,
                'Priority' => $task->priority,
                'Members' => implode(',', $task->members->pluck('name')->toArray()),
                'Is Completed' => $task->is_completed ? 'Yes' : 'No',
                'Deadline' => $task->end_date ?? null,
                'Created at' => $task->created_at->format('d/m/Y'),
                'Last updated' => $task->updated_at->format('d/m/Y'),

            ];
        });
        $this->task_headings = $this->tasks->flatMap(function ($item) {
            return array_keys($item);
        })->unique()->values()->toArray();
    }
    public function collection()
    {
        return $this->tasks;

    }

    public function headings(): array
    {
        return $this->task_headings;
    }
}