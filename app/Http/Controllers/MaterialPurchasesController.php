<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MaterialPurchase; // Eloquent model for MaterialPurchases

class MaterialPurchasesController extends Controller
{
    public function index()
    {
        $purchases = MaterialPurchase::all();
        return response()->json($purchases);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'SupplierID'    => 'required|integer',
            'MaterialID'    => 'required|integer',
            'Quantity'      => 'required|integer',
            'TotalCost'     => 'required|numeric',
            'PurchaseDate'  => 'required|date',
            'PaymentStatus' => 'required|in:Paid,Unpaid',
        ]);

        $purchase = MaterialPurchase::create($validated);
        return response()->json($purchase, 201);
    }

    public function show($id)
    {
        $purchase = MaterialPurchase::findOrFail($id);
        return response()->json($purchase);
    }

    public function update(Request $request, $id)
    {
        $purchase = MaterialPurchase::findOrFail($id);
        $purchase->update($request->all());
        return response()->json($purchase);
    }

    public function destroy($id)
    {
        $purchase = MaterialPurchase::findOrFail($id);
        $purchase->delete();
        return response()->json(null, 204);
    }
}
