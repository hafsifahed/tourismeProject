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
        Schema::create('avis_tours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guide_local')
                ->references('id')
                ->on('guides_locaux')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('utilisateur')
                ->references('id')
                ->on('users')
                ->constrained()
                ->onDelete('cascade');

            $table->string("note");
            $table->string("commentaire");

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
        Schema::dropIfExists('avis_tours');
    }
};
