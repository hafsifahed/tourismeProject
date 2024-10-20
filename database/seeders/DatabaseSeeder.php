<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
<<<<<<< HEAD
=======
use App\Models\Restaurant;
use App\Models\AvisRestaurant;
>>>>>>> 528e72681e5b11cb6df965f1084bc34be9e603d0


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'email' => 'admin@argon.com',
            'password' => bcrypt('secret')
        ]);
<<<<<<< HEAD
=======

        $this->call([
            RestaurantSeeder::class,
        ]);

        $this->call(AvisRestaurantSeeder::class);
>>>>>>> 528e72681e5b11cb6df965f1084bc34be9e603d0
    }
}
