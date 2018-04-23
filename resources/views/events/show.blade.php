@extends('layouts.app')
@section('content')

    <table class="table">
        <thead>
        <tr>
            <td>ID</td>
            <td>Début</td>
            <td>Fin</td>
            <td>Prix</td>
            <td>Evènement</td>
            <td>Création</td>
            <td>Edition</td>
        </tr>
        </thead>
            <tbody>
            <td>{{$event->id}}</td>
            <td>{{$event->dateDebut}}</td>
            <td>{{$event->dateFin}}</td>
            <td>{{$event->prix}}</td>
            <td>{{$event->evenement}}</td>
            <td>{{$event->created_at}}</td>
            <td>{{$event->updated_at}}</td>
            </tbody>
    </table>

@endsection