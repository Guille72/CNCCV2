@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <a href="{{route('noteCreate')}}">Ajout d'une note</a>

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
                <td>Action Editer</td>
                <td>Action Supprimer</td>
                <td>Action Affichage</td>
            </tr>
            </thead>
            @foreach($notes as $note)
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
                <td><a class="btn btn-success" href="{{route('noteEdit', ['id'=>$note->id])}}">Edition</a></td>
                <td>{!! Form::open(['method' => 'DELETE','route' => ['noteDestroy', $note->id]]) !!}
                    {!! Form::token(); !!}
                    {!! Form::submit('Suppression', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}</td>
                <td><a class="btn btn-info" href="{{route('noteShow', ['id'=>$note->id])}}">Afficher</a></td>
                </tbody>
            @endforeach
        </table>
    </div>

@endsection