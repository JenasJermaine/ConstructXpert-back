<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'Projects';

    protected $fillable = [
        'ClientID',
        'ProjectName',
        'StartDate',
        'ExpectedEndDate',
        'ActualEndDate',
        'Budget',
        'Status',
        'Location',
    ];

    public $timestamps = false;

        /**
     * The client that this project belongs to.
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'ClientID');
    }

    /**
     * A project can have many client payments.
     */
    public function clientPayments()
    {
        return $this->hasMany(ClientPayment::class, 'ProjectID');
    }

    /**
     * A project can have many project personnel entries.
     */
    public function projectPersonnel()
    {
        return $this->hasMany(ProjectPersonnel::class, 'ProjectID');
    }

    /**
     * A project can have many project materials.
     */
    public function projectMaterials()
    {
        return $this->hasMany(ProjectMaterial::class, 'ProjectID');
    }

    /**
     * A project can have many equipment assignments.
     */
    public function equipmentAssignments()
    {
        return $this->hasMany(EquipmentAssignment::class, 'ProjectID');
    }

    /**
     * A project can have many laborer wage records.
     */
    public function laborerWages()
    {
        return $this->hasMany(LaborerWage::class, 'ProjectID');
    }
}
