<?php

namespace App\Services;


use App\Models\Task;


class TaskOrderingService
{
    protected TaskLogMessages $taskLogMessages;
    function __construct(TaskLogMessages $taskLogMessages)
    {
        $this->taskLogMessages = $taskLogMessages;
    }

    function changeTaskOrder($new_task_order)
    {
        if (isArrayNull($new_task_order)) {
            foreach ($new_task_order as $single_task) {
                $task = Task::where('id', $single_task['taskID'])->first();
                $task->update([
                    'order' => $single_task['newIndex'],
                ]);
            }


        }
        // if (isArrayNull($dragged_element, $replaced_element)) {
        //     $dragged_task = Task::where('id', $dragged_element['elementID'])->first();
        //     $replaced_task = Task::where('id', $replaced_element['elementID'])->first();
        //     if ($dragged_task && $replaced_task) {
        //         $dragged_task->update([
        //             'order' => $dragged_element['newIndex']
        //         ]);
        //         $replaced_task->update([
        //             'order' => $replaced_element['newIndex']
        //         ]);
        //     }
        // }
    }

    function changeTaskOrderAndGroupTask($new_task_order, $new_group, $dragged_element)
    {
        if (isArrayNull($new_task_order)) {
            foreach ($new_task_order as $single_task) {
                $task = Task::where('id', $single_task['taskID'])->first();
                $task->update([
                    'group_task_id' => $new_group->id,
                    'order' => $single_task['newIndex'],
                ]);
            }

            $message = \App\Enums\TaskLogMessages::GROUP_CHANGED->value . '<strong>' . $new_group->title . '</strong>' . ' ' . 'by: ';
            $this->taskLogMessages->logTaskChanges($dragged_element, $message);
        }
        // if (!is_null($request->newOrder)) {
        //     try {
        //         DB::beginTransaction();
        //         Task::where('group_task_id', $task->group_task_id)
        //             ->where('order', '>=', $request->newOrder)->increment('order');

        //         $task->update([
        //             'order' => $request->newOrder,
        //         ]);
        //         DB::commit();
        //     } catch (\Throwable $th) {
        //         DB::rollBack();
        //         throw $th;
        //     }
        // }
    }
}

function isArrayNull($new_task_order)
{
    return !empty(array_filter($new_task_order, function ($e) {
        return $e !== null;

    }));
}