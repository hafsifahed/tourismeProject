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
        'type_tours',
        'disponibilites',
        'telephone',
        'email',
        'site_web',
        'certification',
        'tour_groupe',
        'tour_prive',
        'photo_url',
    ];
}
