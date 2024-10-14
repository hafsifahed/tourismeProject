<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidatureVolontariat extends Model
{
    use HasFactory;

    protected $table = 'candidatures_volontariat';

    protected $fillable = [
        'nom',
        'email',
        'motivation',
    ];
}
