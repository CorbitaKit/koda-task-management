<?php

namespace App\Enums\Project;

enum ProjectStatus: string
{
    case PENDING = 'Pending';
    case IN_PROGRESS = 'In Progress';
    case COMPLETED = 'Completed';
    case CANCELLED = 'Cancelled';
}