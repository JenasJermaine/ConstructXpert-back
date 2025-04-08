<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonnelSalary extends Model
{
    protected $table = 'PersonnelSalaries';

    protected $fillable = [
        'PersonnelID',
        'PaymentDate',
        'PaymentPeriod',
    ];

    public $timestamps = false;

    /**
     * The personnel associated with this salary record.
     */
    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'PersonnelID');
    }
}
