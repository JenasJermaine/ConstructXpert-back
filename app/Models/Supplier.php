<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'Suppliers';

    protected $fillable = [
        'SupplierName',
        'ContactPerson',
        'Phone',
        'Email',
        'Address',
    ];

    public $timestamps = false;

    
    /**
     * A supplier may have many material purchases.
     */
    public function materialPurchases()
    {
        return $this->hasMany(MaterialPurchase::class, 'SupplierID');
    }
}
