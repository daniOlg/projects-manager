<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'status' => 'required|string|max:50',
            'responsible' => 'required|string|max:100',
            'amount' => 'required|numeric',
        ]);

        $project = Project::create([
            ...$validated,
            'created_by' => auth()->id(),
        ]);

        return response()->json([
            'message' => 'Project created successfully',
            'data' => $project
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
    public function update(Request $request, $id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json(['message' => 'Project not found', 'data' => null], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'start_date' => 'sometimes|date',
            'status' => 'sometimes|string|max:50',
            'responsible' => 'sometimes|string|max:100',
            'amount' => 'sometimes|numeric',
        ]);

        $project->fill($validated);
        $project->save();
        $project->load('creator');

        return response()->json([
            'message' => 'Project updated successfully',
            'data' => $project
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
