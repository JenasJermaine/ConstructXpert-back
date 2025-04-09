<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaborerWage; // Eloquent model for LaborerWages

class LaborerWagesController extends Controller
{
    public function index()
    {
        $wages = LaborerWage::all();
        return response()->json($wages);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'PersonnelID'     => 'required|integer',
            'ProjectID'       => 'required|integer',
            'WeekEndingDate'  => 'required|date',
            'HoursWorked'     => 'required|numeric',
            'TotalAmount'     => 'required|numeric',
        ]);

        $wage = LaborerWage::create($validated);
        return response()->json($wage, 201);
    }

    public function show($id)
    {
        $wage = LaborerWage::findOrFail($id);
        return response()->json($wage);
    }

    public function update(Request $request, $id)
    {
        $wage = LaborerWage::findOrFail($id);
        $wage->update($request->all());
        return response()->json($wage);
    }

    public function destroy($id)
    {
        $wage = LaborerWage::findOrFail($id);
        $wage->delete();
        return response()->json(null, 204);
    }
}
