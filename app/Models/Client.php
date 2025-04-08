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
}
