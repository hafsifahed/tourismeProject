<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use Debugbar;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
        Debugbar::info('Reached RestaurantController index method'); 
        Debugbar::info($restaurants);
        return view('pages.restaurant-list', compact('restaurants'));
    }
}
