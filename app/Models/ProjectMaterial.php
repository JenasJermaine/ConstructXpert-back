<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectMaterial extends Model
{
    protected $table = 'ProjectMaterials';

    protected $fillable = [
        'ProjectID',
        'MaterialID',
        'QuantityUsed',
        'DateIssued',
        'StorekeeperID',
    ];

    public $timestamps = false;

    
    /**
     * The project associated with this material record.
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'ProjectID');
    }

    /**
     * The material that is issued.
     */
    public function material()
    {
        return $this->belongsTo(Material::class, 'MaterialID');
    }

    /**
     * The personnel (storekeeper) who processed this issuance.
     */
    public function storekeeper()
    {
        return $this->belongsTo(Personnel::class, 'StorekeeperID');
    }
}
