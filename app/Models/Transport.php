<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_transport';

    protected $fillable = [
        'type',
        'model',
        'status',
        'prix_heure',  // Updated
        'battrie',
        'lieux_location',  // Updated
        'image_url',
    ];
}
