<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

	public function index()
	{
		$users = User::all();
		return view('users/index', ['users' => $users]);
	}

	public function create()
	{
		return view('users/create');
	}

	public function store(Request $request)
	{
		User::create([
			'name' => $request->name,
			'firstname' => $request->firstname,
			'birthdate' => $request->birthdate,
			'address' => $request->address,
			'zip' => $request->zip,
			'city' => $request->city,
			'tel' => $request->tel,
			'company' => $request->company,
			'siren' => $request->siren,
			'image' => $request->image,
			'tvaInt' => $request->tvaInt,
			'commPriv' => $request->commPriv,
			'email' => $request->email,
			'password' => $request->password,
			'slug' => str_slug(request('name')),
		]);
		return redirect(route('users'));
	}

	public function show($id)
	{
		$user = User::findOrFail($id);
		return view('users/show', ['user' => $user]);
	}

	public function edit($id)
	{
		$user= User::findOrFail($id);
		return view('users/edit', ['user' => $user]);
	}

	public function update(Request $request, $id)
	{
		$user = User::findOrFail($id);

		$user->setAttribute('name', $request->name);
		$user->setAttribute('firstname', $request->firstname);
		$user->setAttribute('birthdate', $request->birthdate);
		$user->setAttribute('address', $request->address);
		$user->setAttribute('zip', $request->zip);
		$user->setAttribute('city', $request->city);
		$user->setAttribute('tel', $request->tel);
		$user->setAttribute('company', $request->company);
		$user->setAttribute('siren', $request->siren);
		$user->setAttribute('image', $request->image);
		$user->setAttribute('tvaInt', $request->tvaInt);
		$user->setAttribute('commPriv', $request->commPriv);
		$user->setAttribute('email', $request->email);
		$user->setAttribute('password', $request->password);

		$user->update();
		return redirect(route('users'));
	}

	public function destroy($id)
	{
		$user = User::findOrFail($id);
		$user->delete();
		return redirect(route('users'));
	}
}
