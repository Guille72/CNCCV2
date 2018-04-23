<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
	protected $fillable = [
		'slug',
		'comm',
		'proprete',
		'accueil',
		'confort',
		'etoile',
		'global',
		'logement_id',
		'user_id',
		];

	public function setTitleAttribute($value)
	{
		$this->attributes['id'] = $value;
		$this->attributes['slug'] = str_slug($value);
	}

	public function logement()
	{
		return $this->hasMany(Logement::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
