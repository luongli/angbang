<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dish', 30);
            $table->timestamps();
        });

        /* add foreign key for dishes table */
        Schema::table('dishes', function ($table) {
            /* id_menu colume references id of menu table */
            $table->integer('id_menu')->unsigned();
            $table->foreign('id_menu')->references('id')->on('menu')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dishes');
    }
}
