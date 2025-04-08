<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'Roles';

    protected $fillable = [
        'RoleName',
        'RequiresCertification',
    ];

    public $timestamps = false;

        /**
     * A role can be assigned to many personnel.
     */
    public function personnel()
    {
        return $this->hasMany(Personnel::class, 'RoleID');
    }
}
