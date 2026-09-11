<?php

namespace App\Models\Project;

use App\Enums\Project\ProjectPriority;
use App\Enums\Project\ProjectStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Project extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'client_name',
        'project_name',
        'description',
        'status',
        'priority',
        'start_date',
        'due_date',
        'user_id',
    ];

    public function casts(): array
    {
        return [
            'status' => ProjectStatus::class,
            'priority' => ProjectPriority::class,
            'start_date' => 'datetime',
            'due_date' => 'datetime',
        ];
    }
}
