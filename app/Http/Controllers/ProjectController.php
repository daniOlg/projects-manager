<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('creator')->get();

        if ($projects->isEmpty()) {
            return response()->json([
                'message' => 'No projects found',
                'data' => []
            ]);
        }

        return response()->json([
            'message' => 'Projects retrieved successfully',
            'data' => $projects
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectStoreRequest $request)
    {
        $validated = $request->validated();

        $project = new Project();
        $project->fill($validated);
        $project->created_by = auth()->id();
        $project->save();

        return response()->json([
            'message' => 'Project created successfully',
            'data' => $project->load('creator')
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $project = Project::with('creator')->find($id);

        if (!$project) {
            return response()->json([
                'message' => 'Project not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'message' => 'Project retrieved successfully',
            'data' => $project
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectUpdateRequest $request, $id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json(['message' => 'Project not found', 'data' => null], 404);
        }

        $validated = $request->validated();

        $project->fill($validated);
        $project->save();

        return response()->json([
            'message' => 'Project updated successfully',
            'data' => $project->load('creator')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json([
                'message' => 'Project not found',
                'data' => null
            ], 404);
        }

        $project->delete();
        return response()->json([], 204);
    }
}
