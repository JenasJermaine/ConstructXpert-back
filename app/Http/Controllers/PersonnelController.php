<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Personnel; // Eloquent model for Personnel

class PersonnelController extends Controller
{
    public function index()
    {
        $personnel = Personnel::all();
        return response()->json($personnel);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Name'                => 'required|string|max:100',
            'Email'               => 'required|email|max:100',
            'Phone'               => 'required|string|max:50',
            'RoleID'              => 'required|integer',
            'CertificationNumber' => 'required|string|max:50',
            'HourlyRate'          => 'nullable|numeric',
            'Salary'              => 'nullable|numeric',
        ]);

        $person = Personnel::create($validated);
        return response()->json($person, 201);
    }

    public function show($id)
    {
        $person = Personnel::findOrFail($id);
        return response()->json($person);
    }

    public function update(Request $request, $id)
    {
        $person = Personnel::findOrFail($id);
        $person->update($request->all());
        return response()->json($person);
    }

    public function destroy($id)
    {
        $person = Personnel::findOrFail($id);
        $person->delete();
        return response()->json(null, 204);
    }
}
