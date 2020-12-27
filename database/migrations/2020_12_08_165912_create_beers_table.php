<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alcohol_volume');
            $table->integer('country_id');
            $table->string('description')->nullable();
            $table->integer('tasting_id')->nullable();
            $table->integer('user_id');
            $table->integer('type_beer_id');
            $table->float('avgAroma')->nullable();
            $table->float('avgTaste')->nullable();
            $table->float('avgColor')->nullable();
            $table->float('avgBitterness')->nullable();
            $table->float('avgTexture')->nullable();
            $table->float('overall')->nullable();
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
        Schema::dropIfExists('beers');
    }
}
