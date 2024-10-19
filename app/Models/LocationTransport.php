<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationTransport extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_location'; // Specify the primary key here

    protected $fillable = [
        'id_transport',
        'user_id',
        'date_debut',
        'date_fin',
        'status',
        'prix_total',
    ];

    // Define the relationship with Transport
    public function transport()
    {
        return $this->belongsTo(Transport::class, 'id_transport', 'id_transport');
    }

    // Define the relationship with User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
