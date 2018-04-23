<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
	public function index()
	{
		$events = Event::all();
		return view('events/index', ['events' => $events]);
	}

	public function create()
	{
		return view('events/create');
	}

	public function store(Request $request)
	{
		Event::create([
			'dateDebut' => $request->dateDebut,
			'dateFin' => $request->dateFin,
			'prix' => $request->prix,
			'evenement' => $request->evenement,
			'slug' => str_slug(request('id')),
		]);
		return redirect(route('events'));
	}

	public function show($id)
	{
		$event = Event::findOrFail($id);
		return view('events/show', ['event' => $event]);
	}

	public function edit($id)
	{
		$event= Event::findOrFail($id);
		return view('events/edit', ['event' => $event]);
	}

	public function update(Request $request, $id)
	{
		$event = Event::findOrFail($id);

		$event->setAttribute('dateDebut', $request->dateDebut);
		$event->setAttribute('dateFin', $request->dateFin);
		$event->setAttribute('prix', $request->prix);
		$event->setAttribute('evenement', $request->evenement);

		$event->update();
		return redirect(route('events'));
	}

	public function destroy($id)
	{
		$event = Event::findOrFail($id);
		$event->delete();
		return redirect(route('events'));
	}
}
