<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectMaterial; // Eloquent model for ProjectMaterials

class ProjectMaterialsController extends Controller
{
    public function index()
    {
        $records = ProjectMaterial::all();
        return response()->json($records);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ProjectID'     => 'required|integer',
            'MaterialID'    => 'required|integer',
            'QuantityUsed'  => 'required|integer',
            'DateIssued'    => 'required|date',
            'StorekeeperID' => 'required|integer',
        ]);

        $record = ProjectMaterial::create($validated);
        return response()->json($record, 201);
    }

    public function show($id)
    {
        $record = ProjectMaterial::findOrFail($id);
        return response()->json($record);
    }

    public function update(Request $request, $id)
    {
        $record = ProjectMaterial::findOrFail($id);
        $record->update($request->all());
        return response()->json($record);
    }

    public function destroy($id)
    {
        $record = ProjectMaterial::findOrFail($id);
        $record->delete();
        return response()->json(null, 204);
    }
}
