<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'required|in:pending,approved,finished,rejected',
            'client_id' => 'required|exists:clients,id',
            'budget_id' => 'required|exists:budgets,id',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ],
                422
            );
        }

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
    public function update(Request $request, Project $project)
    {

        $validator = Validator::make($request->all(), [
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'required|in:pending,approved,finished,rejected',
            'client_id' => 'required|exists:clients,id',
            'budget_id' => 'required|exists:budgets,id',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ],
                422
            );
        }

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
