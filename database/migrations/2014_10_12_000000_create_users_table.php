<?php

use Illuminate\Support\Facades\Schema;
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
            $table->string('name');
            $table->string('firstname');
            $table->string('slug')->nullable();
            $table->date('birthdate');
            $table->string('address');
            $table->string('zip');
            $table->string('city');
            $table->integer('tel');
            $table->string('company')->nullable();
            $table->string('siren')->nullable();
            $table->string('image');
            $table->decimal('tvaInt')->nullable();
            $table->string('commPriv')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
