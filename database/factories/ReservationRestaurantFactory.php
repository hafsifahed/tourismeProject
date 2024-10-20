<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Restaurant;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=ReservationRestaurant>
 */
class ReservationRestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $dateDebut = $this->faker->dateTimeBetween('now', '+1 year');
        $dateFin = $this->faker->dateTimeBetween($dateDebut, '+1 year');

        return [
            'id_restaurant' => Restaurant::factory(),
            'id_utilisateur' => User::factory(),
            'date_debut' => $dateDebut,
            'date_fin' => $dateFin,
        ];
    }
}
