<?php

namespace App\Observers;

use App\Models\Chat;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        try {
            DB::beginTransaction();
            $task->chat()->create();
            if (request()->get('selectedMembers')) {
                foreach (request()->get('selectedMembers') as $single_member) {
                    $task->members()->attach($single_member['id']);
                }
            }

            if (request()->get('attachments')) {
                foreach (request()->get('attachments') as $single_attachment) {
                    $task->attachments()->create([
                        'path' => $single_attachment['path'],
                        'original_name' => $single_attachment['original_name'],
                    ]);
                }
            }


            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }


    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "restored" event.
     */
    public function restored(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "force deleted" event.
     */
    public function forceDeleted(Task $task): void
    {
        //
    }
}