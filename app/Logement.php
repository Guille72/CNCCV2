<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logement extends Model
{
	protected $fillable = [
		'name',
		'slug',
		'address',
		'city',
		'localisation',
		'surface',
		'type',
		'bedroom',
		'coefPrix',
		'description',
		'image',
		'persMax',
		'note_global',
	];

	public function setTitleAttribute($value)
	{
		$this->attributes['name'] = $value;
		$this->attributes['slug'] = str_slug($value);
	}

	public function booking()
	{
		return $this->hasMany(Booking::class);
	}

	public function note()
	{
		return $this->belongsTo(Note::class);
	}
}
