<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdAndMissionIdToCandidaturesVolontariatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidatures_volontariat', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(); // Ajout du champ user_id
            $table->unsignedBigInteger('mission_id')->nullable(); // Ajout du champ mission_id

            // Foreign keys (facultatif, si vous voulez établir des relations avec les autres tables)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('mission_id')->references('id')->on('missions_volontariat')->onDelete('cascade');
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
            $table->dropForeign(['user_id']);
            $table->dropForeign(['mission_id']);
            $table->dropColumn('user_id');
            $table->dropColumn('mission_id');
        });
    }
}