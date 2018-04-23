<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParametrePrix extends Model {

	protected $fillable = [
		'slug',
		'jourAnnul',
		'jourNonAnnul',
		'penalite',
		'remiseSemaine',
		'remiseMois',
		'minFacture',
		'coefPersSupp',
		'forfaitMenage',
		'jourMenage',
		'taxeSejour',
		'tva',
		'prixDef',
		'ville',
		'event_prix',
	];

	public function setTitleAttribute( $value ) {
		$this->attributes['id']   = $value;
		$this->attributes['slug'] = str_slug( $value );
	}

	public function event() {
		return $this->belongsTo( Event::class );
	}
}
