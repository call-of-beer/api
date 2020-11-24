<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_group', function (Blueprint $table) {
            $table->primary(['user_id', 'group_id']);
            $table->integer('user_id');
            $table->integer('group_id');
            $table->timestamps();
            $table->engine = "InnoDB";
            //$table->foreign('user_id')
            //    ->references('id')
           //     ->on('users');
          //   $table->foreign('group_id')
           //     ->references('id')
            //    ->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_group');
    }
}
