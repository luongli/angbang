<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
      
            $table->increments('id');
            $table->string('fname', 30);
            $table->string('mname', 20)->nullable();
            $table->string('lname', 20);
            $table->string('email', 45)->unique();
            $table->date('birthday');
            $table->boolean('sex'); // Male: sex = true
                                    // Female: sex = false
                                    // Other: sex = null
            $table->string('address', 60);
            $table->string('phone', 12);
            $table->integer('type');
            $table->string('password');
            $table->string('remember_token')->nullable();
            $table->string('avatar')->nullable( );
            $table->dateTime('last_login')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
