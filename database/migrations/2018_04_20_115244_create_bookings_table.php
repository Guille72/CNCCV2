<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->nullable();
            $table->date('arrivee');
            $table->date('depart');
            $table->integer('nbPers');
            $table->integer('nbNuit');
            $table->date('annulation');
            $table->decimal('supplement');
            $table->decimal('avoir');
            $table->string('calendrierExt');

            $table->integer('user_id')->unsigned()->nullable();
	        $table->foreign('user_id')
	              ->references('id')
	              ->on('users');

	        $table->integer('logement_id')->unsigned()->nullable();
	        $table->foreign('logement_id')
	              ->references('id')
	              ->on('logements');

	        $table->integer('parametre_prix_id')->unsigned()->nullable();
	        $table->foreign('parametre_prix_id')
	              ->references('id')
	              ->on('parametres_prix');

	        $table->integer('event_dateDebut')->unsigned()->nullable();
	        $table->foreign('event_dateDebut')
	              ->references('dateDebut')
	              ->on('events');

	        $table->integer('event_dateFin')->unsigned()->nullable();
	        $table->foreign('event_dateFin')
	              ->references('dateFin')
	              ->on('events');

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
        Schema::dropIfExists('bookings');
    }
}
