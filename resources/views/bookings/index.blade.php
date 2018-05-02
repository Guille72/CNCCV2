@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <a href="{{route('userCreate')}}">Ajout d'une réservation</a>

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
                <td>Action Editer</td>
                <td>Action Supprimer</td>
                <td>Action Affichage</td>
            </tr>
            </thead>
            @foreach($bookings as $booking)
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

                @if(isset($booking->user))
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
                <td><a class="btn btn-success" href="{{route('bookingEdit', ['id'=>$booking->id])}}">Edition</a></td>
                <td>{!! Form::open(['method' => 'DELETE','route' => ['bookingDestroy', $booking->id]]) !!}
                    {!! Form::token(); !!}
                    {!! Form::submit('Suppression', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}</td>
                <td><a class="btn btn-info" href="{{route('bookingShow', ['id'=>$booking->id])}}">Afficher</a></td>
                </tbody>
            @endforeach
        </table>
    </div>

@endsection