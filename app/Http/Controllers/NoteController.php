<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
	public function index()
	{
		$notes = Note::all();
		return view('notes/index', ['notes' => $notes]);
	}

	public function create()
	{
		return view('notes/create');
	}

	public function store(Request $request)
	{
		Note::create([
			'comm' => $request->comm,
			'proprete' => $request->proprete,
			'accueil' => $request->accueil,
			'confort' => $request->confort,
			'etoile' => $request->etoile,
			'global' => $request->global,
			'slug' => str_slug(request('name')),
		]);
		return redirect(route('notes'));
	}

	public function show($id)
	{
		$note = Note::findOrFail($id);
		return view('notes/show', ['note' => $note]);
	}

	public function edit($id)
	{
		$note= Note::findOrFail($id);
		return view('notes/edit', ['note' => $note]);
	}

	public function update(Request $request, $id)
	{
		$note = Note::findOrFail($id);

		$note->setAttribute('comm', $request->comm);
		$note->setAttribute('proprete', $request->proprete);
		$note->setAttribute('accueil', $request->accueil);
		$note->setAttribute('etoile', $request->etoile);
		$note->setAttribute('confort', $request->confort);
		$note->setAttribute('global', $request->global);

		$note->update();
		return redirect(route('notes'));
	}

	public function destroy($id)
	{
		$note = Note::findOrFail($id);
		$note->delete();
		return redirect(route('notes'));
	}
}
