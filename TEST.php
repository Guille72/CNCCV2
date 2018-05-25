<?php
function dispo_logement( $debut, $fin, $id ) {

	$rep = ( 'SELECT * FROM bookings WHERE annulation IS NULL AND ? BETWEEN arrivee AND date_sub(depart, interval 1 day)' );
	$rep->execute( array( $debut ) );
	$dispoDebut = $rep->fetch();

	if ( isset( $dispoDebut['id'] ) ) {
		if ( $dispoDebut['id'] == $id ) {
			$arrivee = true;
		} else {
			$arrivee = false;
		}
	} else {
		$arrivee = true;
	}

	$rep2 = ( 'SELECT * FROM bookings WHERE annulation IS NULL AND ? BETWEEN date_add(arrivee,interval 1 day) AND depart' );
	$rep2->execute( array( $fin ) );
	$dispoFin = $rep2->fetch();
	if ( isset( $dispoFin['id'] ) ) {
		if ( $dispoFin['id'] == $id ) {
			$depart = true;
		} else {
			$depart = false;
		}
	} else {
		$depart = true;
	}

	$rep3 = ( 'SELECT * FROM bookings WHERE annulation IS NULL AND date_add(?,interval 1 day) < arrivee 
				AND date_sub(?,interval 1 day) > depart' );

	$rep3->execute( array( $debut, $fin ) );
	$dispoPeriode = $rep3->fetch();

	if ( isset( $dispoPeriode['id'] ) ) {
		if ( $dispoPeriode['id'] == $id ) {
			$periode = true;
		} else {
			$periode = false;
		}
	} else {
		$periode = true;
	}

	$rep->closeCursor();
	$rep2->closeCursor();
	$rep3->closeCursor();

	if ( $arrivee == true && $depart == true && $periode == true ) {
		$reponse = true;
	} else {
		$reponse = false;
	}

	return $reponse;
}