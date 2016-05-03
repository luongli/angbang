<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_activity', function (Blueprint $table) {
            $table->increments('id');
            $table->date('act_date');
            $table->timestamps();
        });

        /* add foreign key for class_activity table */
        Schema::table('class_activity', function ($table) {
            /* id_class colume references id of user table */
            $table->integer('id_class')->unsigned();
            $table->foreign('id_class')->references('id')->on('class')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('class_activity');
    }
}
