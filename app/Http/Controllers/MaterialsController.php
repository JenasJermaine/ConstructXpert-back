<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material; // Eloquent model for Materials

class MaterialsController extends Controller
{
    public function index()
    {
        $materials = Material::all();
        return response()->json($materials);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'MaterialName' => 'required|string|max:100',
            'UnitPrice'    => 'required|numeric',
        ]);

        $material = Material::create($validated);
        return response()->json($material, 201);
    }

    public function show($id)
    {
        $material = Material::findOrFail($id);
        return response()->json($material);
    }

    public function update(Request $request, $id)
    {
        $material = Material::findOrFail($id);
        $material->update($request->all());
        return response()->json($material);
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        $material->delete();
        return response()->json(null, 204);
    }
}
