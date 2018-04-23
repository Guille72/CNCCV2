<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->nullable();
            $table->string('comm')->nullable();
            $table->integer('proprete')->nullable();
            $table->integer('accueil')->nullable();
            $table->integer('confort')->nullable();
            $table->integer('etoile')->nullable();
            $table->integer('global')->nullable();

	        $table->integer('logement_id')->unsigned()->nullable();
	        $table->foreign('logement_id')
	              ->references('id')
	              ->on('logements');

	        $table->integer('user_id')->unsigned()->nullable();
	        $table->foreign('user_id')
	              ->references('id')
	              ->on('users');

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
        Schema::dropIfExists('notes');
    }
}
