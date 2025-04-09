<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipment; // Eloquent model for Equipment

class EquipmentController extends Controller
{
    public function index()
    {
        $equipment = Equipment::all();
        return response()->json($equipment);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'EquipmentType' => 'required|string|max:50',
            'EquipmentName' => 'required|string|max:100',
            'RentalRate'    => 'required|numeric',
            'Status'        => 'required|in:Available,Assigned',
        ]);

        $equip = Equipment::create($validated);
        return response()->json($equip, 201);
    }

    public function show($id)
    {
        $equip = Equipment::findOrFail($id);
        return response()->json($equip);
    }

    public function update(Request $request, $id)
    {
        $equip = Equipment::findOrFail($id);
        $equip->update($request->all());
        return response()->json($equip);
    }

    public function destroy($id)
    {
        $equip = Equipment::findOrFail($id);
        $equip->delete();
        return response()->json(null, 204);
    }
}
