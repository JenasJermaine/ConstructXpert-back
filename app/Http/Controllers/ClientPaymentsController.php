<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClientPayment; // Eloquent model for ClientPayments

class ClientPaymentsController extends Controller
{
    public function index()
    {
        $payments = ClientPayment::all();
        return response()->json($payments);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ProjectID'      => 'required|integer',
            'ClientID'       => 'required|integer',
            'Amount'         => 'required|numeric',
            'PaymentDate'    => 'required|date',
            'PaymentMethod'  => 'required|in:Bank Transfer,Cash,Cheque',
        ]);

        $payment = ClientPayment::create($validated);
        return response()->json($payment, 201);
    }

    public function show($id)
    {
        $payment = ClientPayment::findOrFail($id);
        return response()->json($payment);
    }

    public function update(Request $request, $id)
    {
        $payment = ClientPayment::findOrFail($id);
        $payment->update($request->all());
        return response()->json($payment);
    }

    public function destroy($id)
    {
        $payment = ClientPayment::findOrFail($id);
        $payment->delete();
        return response()->json(null, 204);
    }
}
