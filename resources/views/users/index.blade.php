@extends('layouts.app')
@section('content')
<div class="container-fluid">

<a href="{{route('userCreate')}}">Ajout d'un utilisateur</a>

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
        <td>Création</td>
        <td>Edition</td>
        <td>Action Editer</td>
        <td>Action Supprimer</td>
        <td>Action Affichage</td>
    </tr>
    </thead>
    @foreach($users as $user)
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
        <td>{{$user->created_at}}</td>
        <td>{{$user->updated_at}}</td>
        <td><a class="btn btn-success" href="{{route('userEdit', ['id'=>$user->id])}}">Edition</a></td>
        <td>{!! Form::open(['method' => 'DELETE','route' => ['userDestroy', $user->id]]) !!}
            {!! Form::submit('Suppression', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}</td>
        <td><a class="btn btn-info" href="{{route('userShow', ['id'=>$user->id])}}">Afficher</a></td>
        </tbody>
    @endforeach
</table>
</div>

@endsection