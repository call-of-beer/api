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
        Schema::create(
            'ratings', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('aroma');
                $table->integer('color');
                $table->integer('taste');
                $table->integer('bitterness');
                $table->integer('texture');
                $table->integer('overall');
                $table->string('comment')->nullable();
                $table->unsignedInteger('beer_id');
                $table->unsignedInteger('user_id');
                $table->timestamps();
            }
        );
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
