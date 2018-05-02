<?php

namespace App\Http\Controllers;

use App\Parametre;
use Illuminate\Http\Request;

class ParametreController extends Controller
{
	public function index()
	{
		$parametres = Parametre::all();
		return view('parametres/index', ['parametres' => $parametres]);
	}

	public function create()
	{
		return view('parametres/create');
	}

	public function store(Request $request)
	{
		Parametre::create([
			'jourAnnul' => $request->jourAnnul,
			'jourNonAnnul' => $request->jourNonAnnul,
			'penalite' => $request->penalite,
			'remiseSemaine' => $request->remiseSemaine,
			'remiseMois' => $request->remiseMois,
			'coefPersSupp' => $request->coefPersSupp,
			'forfaitMenage' => $request->forfaitMenage,
			'jourMenage' => $request->jourMenage,
			'taxeSejour' => $request->taxeSejour,
			'tva' => $request->tva,
			'prixDef' => $request->prixDef,
			'ville' => $request->ville,
			'slug' => str_slug(request('id')),
		]);
		return redirect(route('parametresPrix'));
	}

	public function show($id)
	{
		$parametre = Parametre::findOrFail($id);
		return view('parametres/show', ['parametre' => $parametre]);
	}

	public function edit($id)
	{
		$parametre= Parametre::findOrFail($id);
		return view('parametres/edit', ['parametre' => $parametre]);
	}

	public function update(Request $request, $id)
	{
		$parametre = Parametre::findOrFail($id);

		$parametre->setAttribute('jourAnnul', $request->jourAnnul);
		$parametre->setAttribute('jourNonAnnul', $request->jourNonAnnul);
		$parametre->setAttribute('penalite', $request->penalite);
		$parametre->setAttribute('remiseSemaine', $request->remiseSemaine);
		$parametre->setAttribute('remiseMois', $request->remiseMois);
		$parametre->setAttribute('minFacture', $request->minFacture);
		$parametre->setAttribute('coefPersSupp', $request->coefPersSupp);
		$parametre->setAttribute('forfaitMenage', $request->forfaitMenage);
		$parametre->setAttribute('taxeSejour', $request->taxeSejour);
		$parametre->setAttribute('tva', $request->tva);
		$parametre->setAttribute('prixDef', $request->prixDef);
		$parametre->setAttribute('ville', $request->ville);

		$parametre->update();
		return redirect(route('parametres'));
	}

	public function destroy($id)
	{
		$parametre = Parametre::findOrFail($id);
		$parametre->delete();
		return redirect(route('parametres'));
	}
}
