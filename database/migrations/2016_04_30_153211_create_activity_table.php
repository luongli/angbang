<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity', function (Blueprint $table) {
            $table->increments('id');
            $table->string('act', 300);
            $table->dateTime('time');
            $table->timestamps();
        });

        /* add foreign key for activity table */
        Schema::table('activity', function ($table) {
            /* id_class_activity colume references id of user table */
            $table->integer('id_class_activity')->unsigned();
            $table->foreign('id_class_activity')->references('id')->on('class_activity')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('activity');
    }
}
