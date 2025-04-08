<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    protected $table = 'Personnel';

    protected $fillable = [
        'Name',
        'Email',
        'Phone',
        'RoleID',
        'CertificationNumber',
        'HourlyRate',
        'Salary',
    ];

    public $timestamps = false;

        /**
     * The role that this personnel belongs to.
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'RoleID');
    }

    /**
     * Personnel may have many project personnel entries.
     */
    public function projectPersonnel()
    {
        return $this->hasMany(ProjectPersonnel::class, 'PersonnelID');
    }

    /**
     * Personnel may have many laborer wage records.
     */
    public function laborerWages()
    {
        return $this->hasMany(LaborerWage::class, 'PersonnelID');
    }

    /**
     * Personnel may have many salary records.
     */
    public function personnelSalaries()
    {
        return $this->hasMany(PersonnelSalary::class, 'PersonnelID');
    }
}
