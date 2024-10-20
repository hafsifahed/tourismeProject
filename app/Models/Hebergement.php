<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hebergement extends Model
{
    use HasFactory;

    // Attributs remplissables
    protected $fillable = [
        'name',
        'type',
        'region',
        'address',
        'description',
        'price_per_night',
        'certification',
        'image'
    ];
     // Ajout d'une méthode pour la recherche
     public static function search($criteria)
     {
         $query = self::query();
 
         if (!empty($criteria['name'])) {
             $query->where('name', 'like', '%' . $criteria['name'] . '%');
         }
 
         if (!empty($criteria['type'])) {
             $query->where('type', $criteria['type']);
         }
 
         if (!empty($criteria['region'])) {
             $query->where('region', $criteria['region']);
         }
 
         if (!empty($criteria['price_min'])) {
             $query->where('price_per_night', '>=', $criteria['price_min']);
         }
 
         if (!empty($criteria['price_max'])) {
             $query->where('price_per_night', '<=', $criteria['price_max']);
         }
 
         return $query->get();
     }
 
    // Relation avec les réservations
    public function reservationsHebergement()
    {
        return $this->hasMany(ReservationsHebergement::class);
    }

    // Relation avec les avis
    public function avis()
    {
        return $this->hasMany(AvisHebergement::class);
    }
}
