<?php

namespace App\Http\Controllers;

use App\ParametrePrix;
use Illuminate\Http\Request;

class ParametrePrixController extends Controller
{
	public function index()
	{
		$parametresPrix = ParametrePrix::all();
		return view('parametresPrix/index', ['parametresPrix' => $parametresPrix]);
	}

	public function create()
	{
		return view('parametresPrix/create');
	}

	public function store(Request $request)
	{
		ParametrePrix::create([
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
		$parametrePrix = ParametrePrix::findOrFail($id);
		return view('parametresPrix/show', ['parametrePrix' => $parametrePrix]);
	}

	public function edit($id)
	{
		$parametrePrix= ParametrePrix::findOrFail($id);
		return view('parametresprix/edit', ['parametrePrix' => $parametrePrix]);
	}

	public function update(Request $request, $id)
	{
		$parametrePrix = ParametrePrix::findOrFail($id);

		$parametrePrix->setAttribute('jourAnnul', $request->jourAnnul);
		$parametrePrix->setAttribute('jourNonAnnul', $request->jourNonAnnul);
		$parametrePrix->setAttribute('penalite', $request->penalite);
		$parametrePrix->setAttribute('remiseSemaine', $request->remiseSemaine);
		$parametrePrix->setAttribute('remiseMois', $request->remiseMois);
		$parametrePrix->setAttribute('minFacture', $request->minFacture);
		$parametrePrix->setAttribute('coefPersSupp', $request->coefPersSupp);
		$parametrePrix->setAttribute('forfaitMenage', $request->forfaitMenage);
		$parametrePrix->setAttribute('taxeSejour', $request->taxeSejour);
		$parametrePrix->setAttribute('tva', $request->tva);
		$parametrePrix->setAttribute('prixDef', $request->prixDef);
		$parametrePrix->setAttribute('ville', $request->ville);

		$parametrePrix->update();
		return redirect(route('parametresPrix'));
	}

	public function destroy($id)
	{
		$parametrePrix = ParametrePrix::findOrFail($id);
		$parametrePrix->delete();
		return redirect(route('parametresPrix'));
	}
}
