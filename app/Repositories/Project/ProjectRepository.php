<?php

namespace App\Repositories\Project;

use App\Models\Project\Project;
use App\Repositories\BaseCrudRepository;
use App\Traits\HasSearch;

use Illuminate\Pagination\LengthAwarePaginator;

class ProjectRepository extends BaseCrudRepository
{
    use HasSearch;
    protected array $filterable = [
        'project_name',
        'description',
        'client_name',
    ];

    public function __construct(private Project $project)
    {
        parent::__construct($this->project);
    }

    public function paginate(
        ?string $search = null, 
        ?string $status = null, 
        ?string $priority = null, 
        int $perPage = 15
    ): LengthAwarePaginator
    {
        $query = $this->project->newQuery();

        if ($search) {
            $this->search($query, $search, $this->filterable);
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($priority) {
            $query->where('priority', $priority);
        }

        return $query->paginate($perPage);
    }
}