<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_restaurants', function (Blueprint $table) {
            $table->id('id_reservation');

            $table->foreignId('id_restaurant')
                ->constrained('restaurants', 'id_restaurant')
                ->onDelete('cascade');

            $table->foreignId('id_utilisateur')
                ->constrained('users', 'id')
                ->onDelete('cascade');
            
            $table->timestamp('date_debut')->nullable();
            $table->timestamp('date_fin')->nullable();
  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation_restaurants');
    }
};
