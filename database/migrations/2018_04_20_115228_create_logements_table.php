<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('localisation');
            $table->decimal('surface');
            $table->string('type');
            $table->integer('bedroom');
            $table->decimal('coefPrix');
            $table->string('description');
            $table->string('image');
            $table->integer('persMax');

	        $table->integer('note_global')->unsigned()->nullable();
	        $table->foreign('note_global')
	              ->references('global')
	              ->on('notes');

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
        Schema::dropIfExists('logements');
    }
}
