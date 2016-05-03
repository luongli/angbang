<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('act_comment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content', 200);
            $table->dateTime('time');
            $table->timestamps();
        });

        /* add foreign key for act_comment table */
        Schema::table('act_comment', function ($table) {
            /* id_class_activity colume references id of class_activity table */
            $table->integer('id_class_activity')->unsigned();
            $table->foreign('id_class_activity')->references('id')->on('class_activity')->onDelete('cascade')->onUpdate('cascade');
            /* id_user references id of user table */
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('act_comment');
    }
}
