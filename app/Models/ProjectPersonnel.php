<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectPersonnel extends Model
{
    protected $table = 'ProjectPersonnel';

    protected $fillable = [
        'ProjectID',
        'PersonnelID',
        'StartDate',
        'EndDate',
    ];

    public $timestamps = false;

        /**
     * The project associated with this record.
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'ProjectID');
    }

    /**
     * The personnel assigned to this project.
     */
    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'PersonnelID');
    }
}
