<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationRestaurant extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_reservation';

    protected $fillable = ['id_restaurant', 'id_utilisateur', 'date_debut', 'date_fin'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'id_restaurant');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_utilisateur');
    }
}
