<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname', 30);
            $table->string('mname', 20)->nullable();
            $table->string('lname', 20);
            $table->date('birthday');
            $table->boolean('sex'); // Male: sex = true
                                    // Female: sex = false
                                    // Other: sex = null
            $table->string('address', 60);
            $table->string('secret_token', 100);
            $table->string('mood', 20);
            $table->string('health', 30);
            $table->float('temperature');
            $table->time('sleep');
            $table->string('food', 40);
        });

        /* add foreign key for children table */
        Schema::table('children', function ($table) {
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
        Schema::drop('children');
    }
}
