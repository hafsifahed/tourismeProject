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
        Schema::create('avis_restaurants', function (Blueprint $table) {
            $table->id('id_avis');

            $table->foreignId('id_restaurant')
                ->constrained('restaurants', 'id_restaurant')
                ->onDelete('cascade');

            $table->foreignId('id_utilisateur')
                ->constrained('users', 'id')
                ->onDelete('cascade');

            $table->unsignedInteger('note')->check(function ($column) {
                return $column->between(1, 5);
            });
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
        Schema::dropIfExists('avis_restaurants');
    }
};
