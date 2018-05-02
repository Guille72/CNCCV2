@extends('layouts.app')
@section('content')

    <a href="{{route('bookings')}}">Liste des réservations</a>
    <a href="{{route('bookingCreate')}}">Créer une réservation</a>

    <a href="{{route('users')}}">Liste des utilisateurs</a>
    <a href="{{route('userCreate')}}">Créer un utilisateur</a>

    <a href="{{route('events')}}">Liste des évènements</a>
    <a href="{{route('eventCreate')}}">Créer évènement</a>

    <a href="{{route('notes')}}">Liste des notes</a>
    <a href="{{route('noteCreate')}}">Créer une note</a>

    <a href="{{route('logements')}}">Liste des logements</a>
    <a href="{{route('logementCreate')}}">Créer un logement</a>

    <a href="{{route('parametresPrix')}}">Liste des paramètres de prix</a>
    <a href="{{route('parametrePrixCreate')}}">Créer un paramètre de prix</a>

@endsection