@extends('layouts.app')
@section('content')

    <table class="table">
        <thead>
        <tr>
            <td>ID</td>
            <td>Arrivée</td>
            <td>Depart</td>
            <td>Personnes</td>
            <td>Nuits</td>
            <td>Annulation</td>
            <td>Supplément</td>
            <td>Avoir</td>
            <td>Calendrier ext.</td>
            <td>Utilisateur</td>
            <td>Logement</td>
            <td>Paramètres</td>
            <td>Evènement</td>
            <td>Création</td>
            <td>Edition</td>
        </tr>
        </thead>
            <tbody>
            <td>{{$booking->id}}</td>
            <td>{{$booking->arrivee}}</td>
            <td>{{$booking->depart}}</td>
            <td>{{$booking->nbPers}}</td>
            <td>{{$booking->nbNuit}}</td>
            <td>{{$booking->annulation}}</td>
            <td>{{$booking->supplement}}</td>
            <td>{{$booking->avoir}}</td>
            <td>{{$booking->calendrierExt}}</td>

            @if(isset($bookin->user))
                <td>{{$booking->user->id}}</td>
            @endif

            @if(isset($booking->logement))
                <td>{{$booking->logement->id}}</td>
            @endif

            @if(isset($booking->parametre_prix))
                <td>{{$booking->parametre_prix->id}}</td>
            @endif

            @if(isset($booking->event))
                <td>{{$booking->event->id}}</td>
            @endif

            <td>{{$booking->created_at}}</td>
            <td>{{$booking->updated_at}}</td>
            </tbody>
    </table>

@endsection