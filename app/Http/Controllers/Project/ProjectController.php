<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Services\Project\ProjectService;
use Exception;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(private ProjectService $projectService){}

    public function index(Request $request)
    {
        $projects = $this->projectService->paginate($request);

        return ProjectResource::collection($projects);
    }

    public function show(int $id)
    {
        return new ProjectResource($this->projectService->view($id));
    }

    public function store(ProjectRequest $request)
    {
        return new ProjectResource($this->projectService->create($request->all()));
    }

    public function update(ProjectRequest $request, int $id)
    {
        return new ProjectResource($this->projectService->update($request->all(), $id));
    }

    public function destroy(int $id)
    {
        return $this->projectService->delete($id);
    }

   
}
