<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'description',
        'date',
        'lieu',
        'image'
    ];

    public function reservations()
    {
        return $this->hasMany(ReservationActivite::class);
    }

    public function avis()
    {
        return $this->hasMany(AvisActivite::class);
    }
}
