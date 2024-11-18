<?php

namespace App\Services;

use App\Models\Task;


class TaskLogMessages
{
    public static function logTaskChanges($task, string $message)
    {
        $task = Task::where('id', $task['id'])->first();
        $chat = $task->chat;
        if ($chat) {
            $chat->messages()->create([
                'user_id' => auth()->id(),
                'message' => $message . auth()->user()->name,
                'is_log' => true,
            ]);
        }
    }
}