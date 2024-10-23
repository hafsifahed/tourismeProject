<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class CandidatureVolontariat extends Model
{
    use HasFactory;

    protected $table = 'candidatures_volontariat';

    protected $fillable = [
        'nom',
        'email',
        'motivation',
        'cv',
        'etat',
        'user_id', // Nouveau champ pour l'ID utilisateur
        'mission_id', // Nouveau champ pour l'ID de la mission
    ];

    // Relation avec le modèle User (Un candidat est lié à un utilisateur)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec le modèle MissionVolontariat (Une candidature est liée à une mission)
    public function mission()
    {
        return $this->belongsTo(MissionVolontariat::class);
    }
}
