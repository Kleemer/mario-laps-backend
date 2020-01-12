<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayerRaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_race', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('position');

            $table->unsignedBigInteger('player_id');
            $table->unsignedBigInteger('race_id');

            $table->timestamps();

            $table->foreign('player_id')
                ->references('id')
                ->on('players');
            $table->foreign('race_id')
                ->references('id')
                ->on('races');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('player_race');
    }
}
