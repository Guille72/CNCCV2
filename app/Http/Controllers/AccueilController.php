<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AccueilController extends Controller {
	public function index() {
		return view( 'index' );
	}

	public function contact() {
		return view( 'layouts/contact' );
	}
}
