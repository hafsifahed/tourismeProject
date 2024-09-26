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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id('id_restaurant');
            $table->string('nom');
            $table->string('adresse');
            $table->string('ville')->nullable();
            $table->string('code_postal', 10)->nullable();
            $table->string('telephone', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('site_web')->nullable();
            $table->string('type_cuisine')->nullable();
            $table->boolean('certification_bio')->default(false);
            $table->boolean('produits_locaux')->default(false);
            $table->boolean('saisonnalite')->default(false);
            $table->boolean('gestion_dechets')->default(false);
            $table->boolean('economie_eau')->default(false);
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
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
        Schema::dropIfExists('restaurants');
    }
};
