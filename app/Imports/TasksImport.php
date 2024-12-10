<?php

namespace App\Imports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class TasksImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Find the existing record
            $task = Task::find($row['id']); // Use your unique identifier here
            if ($task) {
                // Update the existing record
                $task->update([
                    'title' => $row['title'],
                    'description' => $row['description'],
                    'priority' => $row['priority'],
                    'is_completed' => $row['is_completed'] ? true : false,
                ]);
            }
        }
    }
}