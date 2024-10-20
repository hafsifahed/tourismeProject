<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvisActivite extends Model
{
    use HasFactory;

    protected $fillable = ['activite_id', 'utilisateur_id', 'note', 'commentaire'];

    public function activite()
    {
        return $this->belongsTo(Activite::class);
    }
    public function utilisateur()
    {
        return $this->belongsTo(User::class);
    }
}
