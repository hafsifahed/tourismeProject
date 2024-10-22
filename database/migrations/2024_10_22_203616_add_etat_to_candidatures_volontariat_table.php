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
        Schema::table('candidatures_volontariat', function (Blueprint $table) {
            $table->string('etat')->default('en attente')->after('cv'); // Ajouter la colonne 'etat' après 'cv'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidatures_volontariat', function (Blueprint $table) {
            $table->dropColumn('etat'); // Supprimer la colonne 'etat'
        });
    }
};
