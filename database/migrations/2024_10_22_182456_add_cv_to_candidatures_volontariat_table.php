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
            // Add a new string column 'cv' to store the file path
            $table->string('cv')->nullable(); // The CV path can be nullable
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
            // Drop the 'cv' column in case of rollback
            $table->dropColumn('cv');
        });
    }
};
