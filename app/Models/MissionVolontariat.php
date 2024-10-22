<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionVolontariat extends Model
{
    protected $fillable = [
        'titre', 
        'description', 
        'lieu', 
        'date_debut', 
        'date_fin', 
        'nom_association', 
        'description_association',
        'image',
    ];
}

