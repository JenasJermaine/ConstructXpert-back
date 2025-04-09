<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project; // Eloquent model for Projects

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return response()->json($projects);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ClientID'         => 'required|integer',
            'ProjectName'      => 'required|string|max:100',
            'StartDate'        => 'required|date',
            'ExpectedEndDate'  => 'required|date',
            'ActualEndDate'    => 'required|date',
            'Budget'           => 'required|numeric',
            'Status'           => 'required|in:Planning,In Progress,Completed',
            'Location'         => 'nullable|string|max:100',
        ]);

        $project = Project::create($validated);
        return response()->json($project, 201);
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        return response()->json($project);
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->all());
        return response()->json($project);
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return response()->json(null, 204);
    }
}
