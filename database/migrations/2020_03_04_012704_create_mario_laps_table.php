<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarioLapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mario_laps', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
        });

        Schema::table('rounds', function (Blueprint $table) {
            $table->uuid('mario_lap_id');

            $table->foreign('mario_lap_id')
                ->references('id')
                ->on('mario_laps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rounds', function (Blueprint $table) {
            $table->dropForeign(['mario_lap_id']);
        });
        Schema::dropIfExists('mario_laps');
    }
}
