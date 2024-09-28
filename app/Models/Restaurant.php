<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\AvisRestaurant;

class Restaurant extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_restaurant';

    protected $fillable = [
        'nom',
        'adresse', 
        'ville', 
        'code_postal', 
        'telephone', 
        'email',
        'site_web', 
        'type_cuisine', 
        'certification_bio', 
        'produits_locaux',
        'saisonnalite', 
        'gestion_dechets', 
        'economie_eau', 
        'description', 
        'image_url'
    ];

    public function avis()
    {
        return $this->hasMany(AvisRestaurant::class, 'id_restaurant');
    }
}
