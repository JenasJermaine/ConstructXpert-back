<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaborerWage extends Model
{
    protected $table = 'LaborerWages';

    protected $fillable = [
        'PersonnelID',
        'ProjectID',
        'WeekEndingDate',
        'HoursWorked',
        'TotalAmount',
    ];

    public $timestamps = false;

        /**
     * The personnel (laborer) this wage record belongs to.
     */
    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'PersonnelID');
    }

    /**
     * The project associated with this wage record.
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'ProjectID');
    }
}
