<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmslistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smslist', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->text('message');
            $table->boolean('planning');
            $table->tinyInteger('planning_type');
            $table->dateTime('date_start');
            $table->dateTime('date_stop');
            $table->integer('period');
            $table->boolean('smoothly');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('smslist');
    }
}
