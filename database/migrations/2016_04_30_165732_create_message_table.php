<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content', 200);
            $table->timestamps();
        });

        /* add foreign keys */
        Schema::table('message', function ($table) {
            // id_user1 foreign key
            $table->integer('id_user1')->unsigned();
            $table->foreign('id_user1')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            // id_user2 foreign key
            $table->integer('id_user2')->unsigned();
            $table->foreign('id_user2')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('message');
    }
}
