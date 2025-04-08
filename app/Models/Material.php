<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'Materials';

    protected $fillable = [
        'MaterialName',
        'UnitPrice',
    ];

    public $timestamps = false;

        /**
     * A material can be issued to many projects.
     */
    public function projectMaterials()
    {
        return $this->hasMany(ProjectMaterial::class, 'MaterialID');
    }

    /**
     * A material may have many purchase records.
     */
    public function materialPurchases()
    {
        return $this->hasMany(MaterialPurchase::class, 'MaterialID');
    }
}
