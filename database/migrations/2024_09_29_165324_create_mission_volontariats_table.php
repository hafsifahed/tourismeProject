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
        Schema::create('mission_volontariats', function (Blueprint $table) {
            $table->id();
            $table->string('titre'); // Ajout de la colonne 'titre'
            $table->text('description'); // Ajout de la colonne 'description'
            $table->string('lieu'); // Ajout de la colonne 'lieu'
            $table->date('date_debut'); // Ajout de la colonne 'date_debut'
            $table->date('date_fin'); // Ajout de la colonne 'date_fin'
            $table->string('nom_association'); // Ajout de la colonne 'nom_association'
            $table->text('description_association'); // Ajout de la colonne 'description_association'
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
        Schema::dropIfExists('mission_volontariats');
    }
};
