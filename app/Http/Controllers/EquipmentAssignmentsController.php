<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EquipmentAssignment; // Eloquent model for EquipmentAssignments

class EquipmentAssignmentsController extends Controller
{
    public function index()
    {
        $assignments = EquipmentAssignment::all();
        return response()->json($assignments);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'EquipmentID' => 'required|integer',
            'ProjectID'   => 'required|integer',
            'StartDate'   => 'required|date',
            'EndDate'     => 'required|date',
        ]);

        $assignment = EquipmentAssignment::create($validated);
        return response()->json($assignment, 201);
    }

    public function show($id)
    {
        $assignment = EquipmentAssignment::findOrFail($id);
        return response()->json($assignment);
    }

    public function update(Request $request, $id)
    {
        $assignment = EquipmentAssignment::findOrFail($id);
        $assignment->update($request->all());
        return response()->json($assignment);
    }

    public function destroy($id)
    {
        $assignment = EquipmentAssignment::findOrFail($id);
        $assignment->delete();
        return response()->json(null, 204);
    }
}
