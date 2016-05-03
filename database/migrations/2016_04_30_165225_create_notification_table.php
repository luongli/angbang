<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type');
            $table->string('description', 200);
            $table->integer('id_action');
            $table->timestamps();
        });

        /* add foreign keys */
        Schema::table('children_parents', function ($table) {
            // sender foreign key
            $table->integer('sender')->unsigned();
            $table->foreign('sender')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            // receiver foreign key
            $table->integer('receiver')->unsigned();
            $table->foreign('receiver')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('notification');
    }
}
