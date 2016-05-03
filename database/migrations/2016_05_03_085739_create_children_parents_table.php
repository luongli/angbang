<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildrenParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children_parents', function (Blueprint $table) {
            $table->timestamps();
        });

        /* add foreign key for children table */
        Schema::table('children_parents', function ($table) {
            /* id_parent colume references id of user table */
            $table->integer('id_parent')->unsigned();
            $table->foreign('id_parent')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            /* id_child colume references id of children table */
            $table->integer('id_child')->unsigned();
            $table->foreign('id_child')->references('id')->on('children')->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['id_child', 'id_parent']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('children_parents');
    }
}
