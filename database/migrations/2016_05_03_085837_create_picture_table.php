<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePictureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('picture', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url', 200);
            $table->timestamps();
        });

        /* add foreign key for picture table */
        Schema::table('picture', function ($table) {
            /* id_class colume references id of class table */
            $table->integer('id_class')->unsigned();
            $table->foreign('id_class')->references('id')->on('class')->onDelete('cascade')->onUpdate('cascade');
            /* id_post references id of post table */
            $table->integer('id_post')->unsigned()->nullable();
            $table->foreign('id_post')->references('id')->on('post')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('picture');
    }
}
