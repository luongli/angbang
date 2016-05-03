<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_class', function (Blueprint $table) {
            $table->timestamps();
        });

        /* add foreign key for teacher_class table */
        Schema::table('teacher_class', function ($table) {
            /* id_teacher colume references id of user table */
            $table->integer('id_teacher')->unsigned();
            $table->foreign('id_teacher')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            /* id_class colume references id of class table */
            $table->integer('id_class')->unsigned();
            $table->foreign('id_class')->references('id')->on('class')->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['id_teacher', 'id_class']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('teacher_class');
    }
}
