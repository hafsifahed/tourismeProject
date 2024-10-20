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
        Schema::create('hebergements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['Hôtel', 'Maison d’hôtes', 'Camping', 'Appartement', 'Autre']);
            $table->string('region');
            $table->string('address');
            $table->text('description')->nullable();
            $table->decimal('price_per_night', 10, 2);
            $table->string('certification')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('hebergements');
    }
};
