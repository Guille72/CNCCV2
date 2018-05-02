@extends('layouts.app')
@section('content')

    <table class="table">
        <thead>
        <tr>
            <td>ID</td>
            <td>Nom</td>
            <td>Prenom</td>
            <td>Mail</td>
            <td>Naissance</td>
            <td>Adresse</td>
            <td>Code Postal</td>
            <td>Ville</td>
            <td>Téléphone</td>
            <td>Entreprise</td>
            <td>SIREN</td>
            <td>Image</td>
            <td>TVA Int.</td>
            <td>Rôle</td>
            <td>Création</td>
            <td>Edition</td>
        </tr>
        </thead>
            <tbody>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->firstname}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->birthdate}}</td>
            <td>{{$user->address}}</td>
            <td>{{$user->zip}}</td>
            <td>{{$user->city}}</td>
            <td>{{$user->tel}}</td>
            <td>{{$user->company}}</td>
            <td>{{$user->siren}}</td>
            <td>{{$user->image}}</td>
            <td>{{$user->tvaInt}}</td>
            <td>{{$user->role}}</td>
            <td>{{$user->created_at}}</td>
            <td>{{$user->updated_at}}</td>
            </tbody>
    </table>

@endsection