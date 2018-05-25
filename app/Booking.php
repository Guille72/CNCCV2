<?php

namespace App;

use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class Booking
 * @package App
 */
class Booking extends Model {
	/**
	 * @var array
	 */
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

	/**
	 * @param $value
	 */
	public function setTitleAttribute( $value ) {
		$this->attributes['id']   = $value;
		$this->attributes['slug'] = str_slug( $value );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user() {
		return $this->belongsTo( User::class );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function logement() {
		return $this->belongsTo( Logement::class );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function event() {
		return $this->belongsTo( Event::class );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function parametre() {
		return $this->belongsTo( Parametre::class );
	}


	static public function testDispo() {
		$sqlArrivee = 'SELECT arrivee FROM bookings';
		$sqlDepart  = 'SELECT depart FROM bookings';

		if ( ! empty( $sqlArrivee ) && ! empty( $sqlDepart ) ) {
			echo 'Indisponible';
		} else {
			echo 'Disponible';
		}
	}
}