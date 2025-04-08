<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'Equipment';

    protected $fillable = [
        'EquipmentType',
        'EquipmentName',
        'RentalRate',
        'Status',
    ];

    public $timestamps = false;

    
    /**
     * Equipment may have many assignments.
     */
    public function assignments()
    {
        return $this->hasMany(EquipmentAssignment::class, 'EquipmentID');
    }
}
