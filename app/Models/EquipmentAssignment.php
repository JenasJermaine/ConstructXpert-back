<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipmentAssignment extends Model
{
    protected $table = 'EquipmentAssignments';

    protected $fillable = [
        'EquipmentID',
        'ProjectID',
        'StartDate',
        'EndDate',
    ];

    public $timestamps = false;

    
    /**
     * The equipment assigned.
     */
    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'EquipmentID');
    }

    /**
     * The project where the equipment is used.
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'ProjectID');
    }
}
