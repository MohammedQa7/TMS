<?php

namespace App\Services;

use App\Enums\TaskPriorites;

class PriorityService
{
    function retrievePriorities()
    {
        $priorities = collect(TaskPriorites::cases())->map(function ($value) {
            return [
                'value' => $value->value,
                'label' => $value->value,
            ];
        });

        return $priorities;
    }
}