<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationTour extends Model
{
    use HasFactory;

    protected $table = 'reservations_tours';
    protected $fillable = [
        'guide_local',
        'utilisateur',
        'informations'
    ];

    public function guideLocal()
    {
        return $this->belongsTo(GuideLocal::class, 'guide_local');
    }

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'utilisateur');
    }
}
