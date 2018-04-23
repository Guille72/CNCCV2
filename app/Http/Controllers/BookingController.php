<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller {
	public function index() {
		$bookings = Booking::all();

		return view( 'bookings/index', [ 'bookings' => $bookings ] );
	}

	public function create() {
		return view( 'bookings/create' );
	}

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

	public function show( $id ) {
		$booking = Booking::findOrFail( $id );

		return view( 'bookings/show', [ 'booking' => $booking ] );
	}

	public function edit( $id ) {
		$booking = Booking::findOrFail( $id );

		return view( 'bookings/edit', [ 'booking' => $booking ] );
	}

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

	public function destroy( $id ) {
		$booking = Booking::findOrFail( $id );
		$booking->delete();

		return redirect( route( 'bookings' ) );
	}
}
