<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;
use App\Models\User;

class AvisRestaurant extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_avis';

    protected $fillable = ['id_restaurant', 'id_utilisateur', 'note', 'commentaire'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'id_restaurant');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_utilisateur');
    }
}
