<?php

namespace App\Http\Controllers;

use App\Booking;
use DateInterval;
use Illuminate\Http\Request;

/**
 * Class BookingController
 * @package App\Http\Controllers
 */
class BookingController extends Controller {
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index() {
		$bookings = Booking::all();

		return view( 'bookings/index', [ 'bookings' => $bookings ] );
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function create() {
		return view( 'bookings/create' );
	}

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function store( Request $request ) {
		Booking::create( [
			'id'            => $request->id,
			'arrivee'       => $request->arrivee,
			'depart'        => $request->depart,
			'nbPers'        => $request->nbPers,
			'nbNuit'        => $request->nbNuit,
			'annulation'    => $request->annulation,
			'supplement'    => $request->supplement,
			'avoir'         => $request->avoir,
			'calendrierExt' => $request->calendrierExt,
			'slug'          => str_slug( request( 'id' ) ),
		] );

		return redirect( route( 'bookings' ) );
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function show( $id ) {
		$booking = Booking::findOrFail( $id );

		return view( 'bookings/show', [ 'booking' => $booking ] );
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit( $id ) {
		$booking = Booking::findOrFail( $id );

		return view( 'bookings/edit', [ 'booking' => $booking ] );
	}

	/**
	 * @param Request $request
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function update( Request $request, $id ) {
		$booking = Booking::findOrFail( $id );

		$booking->setAttribute( 'nom', $request->nom );
		$booking->setAttribute( 'arrivee', $request->arrivee );
		$booking->setAttribute( 'depart', $request->depart );
		$booking->setAttribute( 'nbPers', $request->nbPers );
		$booking->setAttribute( 'nbNuit', $request->nbNuit );
		$booking->setAttribute( 'annulation', $request->annulation );
		$booking->setAttribute( 'supplement', $request->supplement );
		$booking->setAttribute( 'avoir', $request->avoir );
		$booking->setAttribute( 'calendrierExt', $request->calendrierExt );

		$booking->update();

		return redirect( route( 'bookings' ) );
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function destroy( $id ) {
		$booking = Booking::findOrFail( $id );
		$booking->delete();

		return redirect( route( 'bookings' ) );
	}


	public function Dispo() {

		Booking::testDispo( );

		$bookings = Booking::all( [ 'id', 'arrivee', 'depart' ] );
		return view( 'testDispo', [ 'bookings' => $bookings ] );
	}
}
