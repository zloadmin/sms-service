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
            $table->tinyInteger('smoothly');
            $table->dateTime('start');
            $table->dateTime('stop');
            $table->integer('period');
            $table->boolean('draft')->default(true);
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
        Schema::drop('smslist');
    }
}
