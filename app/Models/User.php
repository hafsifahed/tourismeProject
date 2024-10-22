<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;
use App\Models\ReservationTour;
use App\Models\AvisTour;
use App\Models\TypeTour;

class User extends Authenticable
{
    use HasFactory;

    protected $table = 'users';
    protected $fillable = [
        'username',
        'firstname',
        'lastname',
        'email',
        'password',
        'address',
        'city',
        'country',
        'postal',
        'about'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Always encrypt the password when it is updated.
     *
     * @param $value
    * @return string
    */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function avis()
    {
        return $this->hasMany(AvisRestaurant::class, 'id_utilisateur');
    }

    public function avisa()
    {
        return $this->hasMany(AvisActivite::class);
    }
    public function typeTour()
    {
        return $this->belongsTo(TypeTour::class, 'type_tour');
    }

    public function reservations() {
        return $this->hasMany(ReservationTour::class, 'utilisateur');
    }

    public function avisTours() {
        return $this->hasMany(AvisTour::class, 'utilisateur');
    }
}
