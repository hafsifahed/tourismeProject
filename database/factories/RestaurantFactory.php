<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->company(),
            'adresse' => $this->faker->streetAddress(),
            'ville' => $this->faker->city(),
            'code_postal' => $this->faker->postcode(),
            'telephone' => $this->faker->phoneNumber(),
            'email' => $this->faker->safeEmail(),
            'site_web' => $this->faker->url(),
            'type_cuisine' => $this->faker->randomElement(['Française', 'Italienne', 'Japonaise', 'Chinoise', 'Indienne']),
            'certification_bio' => $this->faker->boolean(),
            'produits_locaux' => $this->faker->boolean(),
            'saisonnalite' => $this->faker->boolean(),
            'gestion_dechets' => $this->faker->boolean(),
            'economie_eau' => $this->faker->boolean(),
            'description' => $this->faker->paragraph(),
            'image_url' => $this->faker->imageUrl(640, 480, 'food', true),
        ];
    }
}
