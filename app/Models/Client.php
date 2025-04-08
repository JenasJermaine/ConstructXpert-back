<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'Clients';

    protected $fillable = [
        'Name',
        'ContactPerson',
        'Phone',
        'Email',
        'Address',
        'ContractDetails',
    ];

    public $timestamps = false;

        /**
     * A client can have many projects.
     */
    public function projects()
    {
        return $this->hasMany(Project::class, 'ClientID');
    }

    /**
     * A client may have many payments.
     */
    public function clientPayments()
    {
        return $this->hasMany(ClientPayment::class, 'ClientID');
    }
}
