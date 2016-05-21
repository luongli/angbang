<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationTable extends Migration
{
    /**
     * Run the migrations.
     * type = 1 if Act table is changed
     * type = 2 if ActComment is changed
     * type = 3 if Children  is changed
     * type = 4 if Picture table is changed
     * type = 5 if PostComment table is changed
     * type = 6 if MenuTable is changed
     * type = 7 if Message table is changed
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
        Schema::table('notification', function ($table) {
            // sender foreign key
            $table->integer('sender')->unsigned();
            $table->foreign('sender')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            // receiver foreign key
            $table->integer('class_id')->unsigned();
            $table->foreign('class_id')->references('id')->on('class')->onDelete('cascade')->onUpdate('cascade');
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
