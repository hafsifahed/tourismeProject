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
        Schema::create('location_transports', function (Blueprint $table) {
            $table->id('id_location'); // Clé primaire
            $table->foreignId('id_transport')->constrained(); // Clé étrangère vers la table transports
            $table->foreignId('user_id')->constrained(); // Clé étrangère vers la table users
            $table->dateTime('date_debut'); // Date de début
            $table->dateTime('date_fin'); // Date de fin
            $table->string('status'); // Statut
            $table->decimal('prix_total', 10, 2); // Prix total
            $table->timestamps(); // Création des colonnes created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location_transports');
    }
};
