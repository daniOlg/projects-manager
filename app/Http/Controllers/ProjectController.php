<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::query()
            ->orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('projects/list', [
            'projects' => $projects,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('projects/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'status' => 'required|string',
            'responsible' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        $validated['id'] = (string) \Illuminate\Support\Str::uuid();

        Project::create($validated);

//        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::where('id', $id)->first();

        if (!$project) {
            return response()->json(['message' => 'The project you are trying to view does not exist.'], 404);
        }

        return Inertia::render('projects/show', [
            'project' => $project,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::where('id', $id)->first();

        if (!$project) {
            return response()->json(['message' => 'The project you are trying to edit does not exist.'], 404);
        }

        return Inertia::render('projects/edit', [
            'project' => $project,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $project = Project::where('id', $request->id)->first();

        if (!$project) {
            return response()->json(['message' => 'The project you are trying to update does not exist.'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'status' => 'required|string',
            'responsible' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        $validated['id'] = $project->id;

        $project->update($validated);

//        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::where('id', $id)->first();

        if (!$project) {
            return response()->json(['message' => 'The project you are trying to delete does not exist.'], 404);
        }

        $project->delete();

//        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
