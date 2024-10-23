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
        Schema::table('mission_volontariats', function (Blueprint $table) {
            $table->string('image')->nullable()->after('description_association'); // Ajouter la colonne 'image' après 'description_association'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mission_volontariats', function (Blueprint $table) {
            $table->dropColumn('image'); // Supprimer la colonne 'image'
        });
    }
};
