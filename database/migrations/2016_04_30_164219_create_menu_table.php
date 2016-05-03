<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id');
            
            $table->timestamps();
        });

        /* add foreign key for menu table */
        Schema::table('menu', function ($table) {
            /* id_class colume references id of class table */
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
        Schema::drop('menu');
    }
}
