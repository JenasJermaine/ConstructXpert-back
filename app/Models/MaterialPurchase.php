<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialPurchase extends Model
{
    protected $table = 'MaterialPurchases';

    protected $fillable = [
        'SupplierID',
        'MaterialID',
        'Quantity',
        'TotalCost',
        'PurchaseDate',
        'PaymentStatus',
    ];

    public $timestamps = false;

        /**
     * The supplier associated with this purchase.
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'SupplierID');
    }

    /**
     * The material being purchased.
     */
    public function material()
    {
        return $this->belongsTo(Material::class, 'MaterialID');
    }
}
