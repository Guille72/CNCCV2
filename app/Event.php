<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	protected $fillable = [
		'slug',
		'dateDebut',
		'dateFin',
		'prix',
		'evenement',
	];
	public function setTitleAttribute($value)
	{
		$this->attributes['id'] = $value;
		$this->attributes['slug'] = str_slug($value);
	}

	public function booking()
	{
		return $this->hasMany(Booking::class);
	}

	public function parametrePrix()
	{
		return $this->hasMany(Parametre::class);
	}
}
