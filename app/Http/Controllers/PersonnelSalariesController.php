<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PersonnelSalary; // Eloquent model for PersonnelSalaries

class PersonnelSalariesController extends Controller
{
    public function index()
    {
        $salaries = PersonnelSalary::all();
        return response()->json($salaries);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'PersonnelID'   => 'required|integer',
            'PaymentDate'   => 'required|date',
            'PaymentPeriod' => 'required|string|max:50',
        ]);

        $salary = PersonnelSalary::create($validated);
        return response()->json($salary, 201);
    }

    public function show($id)
    {
        $salary = PersonnelSalary::findOrFail($id);
        return response()->json($salary);
    }

    public function update(Request $request, $id)
    {
        $salary = PersonnelSalary::findOrFail($id);
        $salary->update($request->all());
        return response()->json($salary);
    }

    public function destroy($id)
    {
        $salary = PersonnelSalary::findOrFail($id);
        $salary->delete();
        return response()->json(null, 204);
    }
}
