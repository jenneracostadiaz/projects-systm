<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::paginate(10);
        return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $project = new Project($request->input());
        $project->save();

        return response()->json(
            [
                'status' => true,
                'message' => 'Project created successfully',
                'data' => $project
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return response()->json([
            'status' => true,
            'data' => $project
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $project->update($request->input());
        return response()->json(
            [
                'status' => true,
                'message' => 'Project updated successfully',
                'data' => $project
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(
            [
                'status' => true,
                'message' => 'Project deleted successfully'
            ]
        );
    }
}
