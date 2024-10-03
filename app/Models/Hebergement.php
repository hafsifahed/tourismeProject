<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hebergement extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'type', 'region','address', 'description', 'price_per_night', 
        'certification', 'image'
    ];

  /*   // Relation avec le modèle User (Propriétaire)
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    } */
}
