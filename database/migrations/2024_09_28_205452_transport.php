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
        Schema::create('transports', function (Blueprint $table) {
            $table->bigIncrements('id_transport'); // Custom primary key

            $table->string('type');
            $table->string('model')->nullable();
            $table->string('status')->nullable(); // Enum for better status management
            $table->decimal('prix_heure', 8, 2)->nullable(); // Updated
            $table->integer('battrie')->nullable(); // Assuming it's a percentage (0-100)
            $table->string('lieux_location')->nullable(); // Updated
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
        Schema::dropIfExists('transports');
    }
};
