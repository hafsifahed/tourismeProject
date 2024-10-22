<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuideLocal extends Model
{
    use HasFactory;

    protected $table = 'guides_locaux';
    protected $fillable = [
        'nom',
        'description',
        'region',
        'ville',
        'type_tour',
        'disponibilites',
        'telephone',
        'email',
        'site_web',
        'certification',
        'tour_groupe',
        'tour_prive',
        'photo_url'
    ];

    public function typeTour()
    {
        return $this->belongsTo(TypeTour::class, 'type_tour');
    }

    public function reservations()
    {
        return $this->hasMany(ReservationTour::class, 'guide_local');
    }

    public function avis()
    {
        return $this->hasMany(AvisTour::class, 'guide_local');
    }
}
