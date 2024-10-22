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

// namespace App\Http\Controllers;

// use App\Models\GuideLocal;
// use Illuminate\Http\Request;

// class GuideLocalController extends Controller
// {
//     // Retrieve all guides
//     public function index()
//     {
//         return GuideLocal::all();
//     }

//     // Create a new guide
//     public function store(Request $request)
//     {
//         $validatedData = $request->validate([
//             'nom' => 'required|string|max:255',
//             'type_tour' => 'required|exists:types_tours,id',
//             'description' => 'nullable|string',
//             'region' => 'nullable|string',
//             'ville' => 'nullable|string',
//             'disponibilites' => 'nullable|string',
//             'telephone' => 'nullable|string|max:20',
//             'email' => 'nullable|email|max:100',
//             'site_web' => 'nullable|url',
//             'certification' => 'boolean',
//             'tour_groupe' => 'boolean',
//             'tour_prive' => 'boolean',
//             'photo_url' => 'nullable|string',
//         ]);

//         $guide = GuideLocal::create($validatedData);
//         return response()->json($guide, 201);
//     }

//     // Retrieve a specific guide by ID
//     public function show($id)
//     {
//         $guide = GuideLocal::findOrFail($id);
//         return response()->json($guide);
//     }

//     // Update a guide
//     public function update(Request $request, $id)
//     {
//         $guide = GuideLocal::findOrFail($id);
//         $guide->update($request->all());
//         return response()->json($guide, 200);
//     }

//     // Delete a guide
//     public function destroy($id)
//     {
//         $guide = GuideLocal::findOrFail($id);
//         $guide->delete();
//         return response()->json(null, 204);
//     }
// }
