<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ReservationsHebergement extends Model
{
    use HasFactory;

    protected $fillable = [
        'hebergement_id',
        'user_id',
        'start_date', // Renommé depuis 'date_debut' pour correspondre à la table de migration
        'end_date',   // Renommé depuis 'date_fin' pour correspondre à la table de migration
        'guests',     // Nombre d'invités
        'total_price', // Prix total de la réservation
        'status',     // Statut de la réservation (en attente, confirmée, annulée)
        'special_requests' // Demandes spéciales (facultatif)
    ];
    public function hebergement()
    {
        return $this->belongsTo(Hebergement::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function totalReservations()
{
    return self::count();
}

public static function reservationsByStatus()
{
    return self::select('status', DB::raw('count(*) as count'))
        ->groupBy('status')
        ->get();
}

public static function totalRevenue() 
{
    return self::where('status', 'confirmée')->sum('total_price');
}


public static function monthlyReservations()
{
    return self::select(DB::raw('MONTH(start_date) as month, COUNT(*) as count'))
        ->groupBy('month')
        ->orderBy('month')
        ->get();
}
}
