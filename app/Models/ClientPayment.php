<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientPayment extends Model
{
    // Specify the table if not using Laravel’s plural snake_case naming convention
    protected $table = 'ClientPayments';

    // Attributes that can be mass assigned.
    protected $fillable = [
        'ProjectID',
        'ClientID',
        'Amount',
        'PaymentDate',
        'PaymentMethod',
    ];

    // Disable timestamps if your table does not have created_at/updated_at
    public $timestamps = false;

        /**
     * The project that this payment belongs to.
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'ProjectID');
    }

    /**
     * The client that made this payment.
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'ClientID');
    }
}
