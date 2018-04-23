@extends('layouts.app')
@section('content')

    <table class="table">
        <thead>
        <tr>
            <td>ID</td>
            <td>Propreté</td>
            <td>Accueil</td>
            <td>Confort</td>
            <td>Etoile</td>
            <td>Global</td>
            <td>Logement</td>
            <td>Utilisateur</td>
            <td>Création</td>
            <td>Edition</td>
        </tr>
        </thead>
            <tbody>
            <td>{{$note->id}}</td>
            <td>{{$note->proprete}}</td>
            <td>{{$note->accueil}}</td>
            <td>{{$note->confort}}</td>
            <td>{{$note->etoile}}</td>
            <td>{{$note->global}}</td>

            @if(isset($note->logement))
                <td>{{$note->logement->id}}</td>
            @endif

            @if(isset($note->user))
                <td>{{$note->user->id}}</td>
            @endif

            <td>{{$note->created_at}}</td>
            <td>{{$note->updated_at}}</td>
            </tbody>
    </table>

@endsection