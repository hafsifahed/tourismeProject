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
        Schema::create('candidatures_volontariat', function (Blueprint $table) {
            $table->id(); // Identifiant unique pour la candidature
            $table->string('nom'); // Nom du candidat
            $table->string('email'); // Email du candidat
            $table->text('motivation'); // Lettre de motivation du candidat
            $table->timestamps(); // Conserve les colonnes 'created_at' et 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidatures_volontariat');
    }
};
