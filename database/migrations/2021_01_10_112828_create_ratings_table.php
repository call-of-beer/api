<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->integer('aroma');
            $table->integer('color');
            $table->integer('taste');
            $table->integer('bitterness');
            $table->integer('texture');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('beer_id');
            $table->unsignedBigInteger('tasting_id');
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
        Schema::dropIfExists('ratings');
    }
}
