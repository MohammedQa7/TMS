<?php

namespace App\Enums;


enum TaskLogMessages: string
{
    case GROUP_CHANGED = 'Task has been moved to ';
    case TASK_ORDER_CHANGED = 'Task has been re-orderd';
    case PRIORITY_CHANGED = 'Task prority has changed to';
}