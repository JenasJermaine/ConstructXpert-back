<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectPersonnel; // Eloquent model for ProjectPersonnel

class ProjectPersonnelController extends Controller
{
    public function index()
    {
        $records = ProjectPersonnel::all();
        return response()->json($records);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ProjectID'   => 'required|integer',
            'PersonnelID' => 'required|integer',
            'StartDate'   => 'required|date',
            'EndDate'     => 'required|date',
        ]);

        $record = ProjectPersonnel::create($validated);
        return response()->json($record, 201);
    }

    public function show($id)
    {
        $record = ProjectPersonnel::findOrFail($id);
        return response()->json($record);
    }

    public function update(Request $request, $id)
    {
        $record = ProjectPersonnel::findOrFail($id);
        $record->update($request->all());
        return response()->json($record);
    }

    public function destroy($id)
    {
        $record = ProjectPersonnel::findOrFail($id);
        $record->delete();
        return response()->json(null, 204);
    }
}
