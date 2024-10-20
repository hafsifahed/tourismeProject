<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeTour extends Model
{
    use HasFactory;

    protected $table = 'types_tours';
    protected $fillable = ['nom_tour'];

    public function guidesLocaux()
    {
        return $this->hasMany(GuideLocal::class, 'type_tour');
    }
}
