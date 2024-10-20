<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvisHebergement extends Model
{
    use HasFactory;

    protected $fillable = [
        'hebergement_id',
        'user_id',
        'commentaire',
        'rating',
    ];

    public function hebergement()
    {
        return $this->belongsTo(Hebergement::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
