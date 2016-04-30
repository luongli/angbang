<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildrensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('childrens', function (Blueprint $table) {
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('childrens');
    }
}
