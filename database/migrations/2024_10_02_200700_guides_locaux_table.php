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
        Schema::create('guides_locaux', function (Blueprint $table) {
            $table->id('id');
            $table->string('nom');
            $table->text('description')->nullable();
            $table->string('region')->nullable();
            $table->string('ville')->nullable();
            $table->foreignId('type_tour')
                ->references('id')
                ->on('types_tours')
                ->constrained()
                ->onDelete('cascade');
            $table->string('disponibilites')->nullable();
            $table->string('telephone', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('site_web')->nullable();
            $table->boolean('certification')->default(false);
            $table->boolean('tour_groupe')->default(false);
            $table->boolean('tour_prive')->default(false);
            $table->string('photo_url')->nullable();
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
        Schema::dropIfExists('guides_locaux');
    }
};
