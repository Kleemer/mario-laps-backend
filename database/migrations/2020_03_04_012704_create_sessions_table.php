<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
        });

        Schema::table('mario_laps', function (Blueprint $table) {
            $table->uuid('session_id');

            $table->foreign('session_id')
                ->references('id')
                ->on('sessions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mario_laps', function (Blueprint $table) {
            $table->dropForeign(['session_id']);
        });
        Schema::dropIfExists('sessions');
    }
}
