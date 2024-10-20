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
        Schema::create('reservations_hebergements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hebergement_id')->constrained('hebergements')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('start_date'); // anciennement 'check_in'
            $table->date('end_date');   // anciennement 'check_out'
            $table->integer('guests');
            $table->decimal('total_price', 8, 2);
            $table->enum('status', ['en attente', 'confirmée', 'annulée'])->default('en attente'); // Nouveau champ pour le statut
            $table->text('special_requests')->nullable(); // Champ optionnel pour les demandes spéciales
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
        Schema::dropIfExists('reservations_hebergements');
    }
};
