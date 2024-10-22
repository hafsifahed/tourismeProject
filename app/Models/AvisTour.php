<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvisTour extends Model
{
    use HasFactory;

    protected $table = 'avis_tours';
    protected $fillable = [
        'guide_local',
        'utilisateur',
        'note',
        'commentaire'
    ];

    public function guideLocal()
    {
        return $this->belongsTo(GuideLocal::class, 'guide_local');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'utilisateur');
    }
}
