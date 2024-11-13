<?php

namespace App\Enums;


enum TaskPriorites: string
{
    case LOW = 'Low';
    case NORMAL = 'Normal';
    case URGENT = 'Urgent';
}