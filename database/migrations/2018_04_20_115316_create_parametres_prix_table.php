<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParametresPrixTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parametres_prix', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->nullable();
            $table->integer('jourAnnul');
            $table->integer('jourNonAnnul');
            $table->decimal('penalite');
            $table->decimal('remiseSemaine');
            $table->decimal('remiseMois');
            $table->decimal('minFacture');
            $table->decimal('coefPersSupp');
            $table->decimal('forfaitMenage');
            $table->decimal('jourMenage');
            $table->decimal('taxeSejour');
            $table->decimal('tva');
            $table->decimal('prixDef');
            $table->decimal('ville');

	        $table->integer('event_prix')->unsigned()->nullable();
	        $table->foreign('event_prix')
	              ->references('prix')
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
        Schema::dropIfExists('parametres_prix');
    }
}
