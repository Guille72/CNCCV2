<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DroitController extends Controller
{
    public function mention(){
    	return view('droits/ml');
    }

	public function condition(){
		return view('droits/cu');
	}
}
