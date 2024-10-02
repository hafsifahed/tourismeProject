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
        Schema::create('avis_activites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activite_id')->constrained()->onDelete('cascade');
            $table->foreignId('utilisateur_id')->constrained()->onDelete('cascade');
            $table->integer('note')->between(1, 5);
            $table->text('commentaire')->nullable();
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
        Schema::dropIfExists('avis_activites');
    }
};
