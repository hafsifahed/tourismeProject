<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AvisRestaurant;
use App\Models\Restaurant;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=AvisRestaurant>
 */
class AvisRestaurantFactory extends Factory
{
    protected $model = AvisRestaurant::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_restaurant' => Restaurant::factory(),
            'id_utilisateur' => User::factory(),
            'note' => $this->faker->numberBetween(1, 5),
            'commentaire' => $this->faker->sentence(), 
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
