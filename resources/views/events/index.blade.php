@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <a href="{{route('eventCreate')}}">Ajout d'un évènement</a>

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
                <td>Action Editer</td>
                <td>Action Supprimer</td>
                <td>Action Affichage</td>
            </tr>
            </thead>
            @foreach($events as $event)
                <tbody>
                <td>{{$event->id}}</td>
                <td>{{$event->dateDebut}}</td>
                <td>{{$event->dateFin}}</td>
                <td>{{$event->prix}}</td>
                <td>{{$event->evenement}}</td>
                <td>{{$booking->created_at}}</td>
                <td>{{$booking->updated_at}}</td>
                <td><a class="btn btn-success" href="{{route('eventEdit', ['id'=>$event->id])}}">Edition</a></td>
                <td>{!! Form::open(['method' => 'DELETE','route' => ['eventDestroy', $event->id]]) !!}
                    {!! Form::submit('Suppression', ['class' => 'btn btn-danger']) !!}
                    {!! Form::token(); !!}
                    {!! Form::close() !!}</td>
                <td><a class="btn btn-info" href="{{route('eventShow', ['id'=>$event->id])}}">Afficher</a></td>
                </tbody>
            @endforeach
        </table>
    </div>

@endsection