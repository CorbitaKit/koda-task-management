<?php

namespace App\Services\Project;

use App\Repositories\Project\ProjectRepository;
use App\Services\BaseCrudService;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;


class ProjectService extends BaseCrudService
{
    public function __construct(private ProjectRepository $projectRepository)
    {
        parent::__construct($projectRepository);
    }

    public function paginate(Request $request):  LengthAwarePaginator
    {
        $filter = $request['search'] ?? null;
        $perPage = $request['per_page'] ?? 10;
        $status = $request['status'] ?? null;
        $prioriry = $request['priority'] ?? null;

        return $this->projectRepository->paginate($filter, $status, $prioriry, $perPage);
    }


}