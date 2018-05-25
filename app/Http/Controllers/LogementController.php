<?php

namespace App\Http\Controllers;

use App\Logement;
use Illuminate\Http\Request;

class LogementController extends Controller
{
	public function index()
	{
		$logements = Logement::all();
		return view('logements/index', ['logements' => $logements]);
	}

	public function create()
	{
		return view('logements/create');
	}

	public function store(Request $request)
	{
		Logement::create([
			'name' => $request->name,
			'address' => $request->address,
			'prix' => $request->prix,
			'city' => $request->city,
			'localisation' => $request->localisation,
			'surface' => $request->surface,
			'type' => $request->type,
			'bedroom' => $request->bedroom,
			'coefPrix' => $request->coefPrix,
			'description' => $request->description,
			'image' => $request->image,
			'persMax' => $request->persMax,
			'slug' => str_slug(request('name')),
		]);
		return redirect(route('logements'));
	}

	public function show($id)
	{
		$logement = Logement::findOrFail($id);
		return view('logements/show', ['logement' => $logement]);
	}

	public function edit($id)
	{
		$logement= Logement::findOrFail($id);
		return view('logements/edit', ['logement' => $logement]);
	}

	public function update(Request $request, $id)
	{
		$logement = Logement::findOrFail($id);

		$logement->setAttribute('name', $request->name);
		$logement->setAttribute('address', $request->address);
		$logement->setAttribute('city', $request->city);
		$logement->setAttribute('localisation', $request->localisation);
		$logement->setAttribute('surface', $request->surface);
		$logement->setAttribute('type', $request->type);
		$logement->setAttribute('bedroom', $request->bedroom);
		$logement->setAttribute('coefPrix', $request->coefPrix);
		$logement->setAttribute('description', $request->description);
		$logement->setAttribute('image', $request->image);

		$logement->update();
		return redirect(route('logements'));
	}

	public function destroy($id)
	{
		$logement = Logement::findOrFail($id);
		$logement->delete();
		return redirect(route('logements'));
	}

	public function champion(){
		return view('logements/maisonChampion');
	}

	public function painLeve(){
		return view('logements/maisonPainLeve');
	}

	public function rousseau(){
		return view('logements/maisonRousseau');
	}
}
