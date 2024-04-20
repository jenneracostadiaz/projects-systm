<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::paginate(10);
        return $this->getResponse(true, 'Projects retrieved successfully', $projects);
    }

    public function store(ProjectRequest $request)
    {
        $project = new Project($request->input());
        $project->save();
        return $this->getResponse(true, 'Project created successfully', $project);
    }

    public function show(Project $project)
    {
        return $this->getResponse(true, 'Project retrieved successfully', $project);
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $project->update($request->input());
        return $this->getResponse(true, 'Project updated successfully', $project);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return $this->getResponse(true, 'Project deleted successfully');
    }
}
