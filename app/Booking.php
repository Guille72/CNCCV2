<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
	protected $fillable = [
		'slug',
		'arrivee',
		'depart',
		'nbPers',
		'nbNuit',
		'annulation',
		'supplement',
		'avoir',
		'calendrierExt',
		'user_id',
		'logement_id',
		'parametre_prix_id',
		'event_dateDebut',
		'event_dateFin',
	];

	public function setTitleAttribute($value)
	{
		$this->attributes['id'] = $value;
		$this->attributes['slug'] = str_slug($value);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function logement()
	{
		return $this->belongsTo(Logement::class);
	}

	public function event()
	{
		return $this->belongsTo(Event::class);
	}

	public function parametre()
	{
		return $this->belongsTo(Parametre::class);
	}

}
