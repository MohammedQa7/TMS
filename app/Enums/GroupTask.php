<?php

namespace App\Enums;


enum GroupTask: string
{
    case TODO = 'To do';
    case REVIEW = 'Review';
    case COMPLETED = 'Completed';
}