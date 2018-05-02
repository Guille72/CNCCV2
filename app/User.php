<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
	    'email',
	    'password',
	    'firstname',
	    'slug',
	    'birthdate',
	    'address',
	    'zip',
	    'city',
	    'tel',
	    'company',
	    'siren',
	    'image',
	    'tvaInt',
	    'commPriv',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	public function setTitleAttribute($value)
	{
		$this->attributes['name'] = $value;
		$this->attributes['slug'] = str_slug($value);
	}

	public function booking()
	{
		return $this->hasOne(Booking::class);
	}

	public function note()
	{
		return $this->hasOne(User::class);
	}

	/**
	 * checks if the user belongs to a particular group
	 * @param string|array $role
	 * @return bool
	 */
	public function role($role) {
		$role = (array)$role;
		return in_array($this->role, $role);
	}
}
