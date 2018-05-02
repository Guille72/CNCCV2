@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <a href="{{route('logementCreate')}}">Ajout d'un logement</a>

        <table class="table">
            <thead>
            <tr>
                <td>ID</td>
                <td>Nom</td>
                <td>Adresse</td>
                <td>Ville</td>
                <td>Localisation</td>
                <td>Surface</td>
                <td>Type</td>
                <td>Chambres</td>
                <td>Coef. prix</td>
                <td>Description</td>
                <td>Image</td>
                <td>Personnes max.</td>
                <td>Note</td>
                <td>Création</td>
                <td>Edition</td>
                <td>Action Editer</td>
                <td>Action Supprimer</td>
                <td>Action Affichage</td>
            </tr>
            </thead>
            @foreach($logements as $logement)
                <tbody>
                <td>{{$logement->id}}</td>
                <td>{{$logement->name}}</td>
                <td>{{$logement->address}}</td>
                <td>{{$logement->city}}</td>
                <td>{{$logement->localisation}}</td>
                <td>{{$logement->surface}}</td>
                <td>{{$logement->type}}</td>
                <td>{{$logement->bedroom}}</td>
                <td>{{$logement->coefPrix}}</td>
                <td>{{$logement->description}}</td>
                <td>{{$logement->image}}</td>
                <td>{{$logement->persMax}}</td>

                @if(isset($logement->note))
                    <td>{{$logement->note->global}}</td>
                @endif

                <td>{{$logement->created_at}}</td>
                <td>{{$logement->updated_at}}</td>
                <td><a class="btn btn-success" href="{{route('logementEdit', ['id'=>$logement->id])}}">Edition</a></td>
                <td>{!! Form::open(['method' => 'DELETE','route' => ['logementDestroy', $logement->id]]) !!}
                    {!! Form::token(); !!}
                    {!! Form::submit('Suppression', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}</td>
                <td><a class="btn btn-info" href="{{route('logementShow', ['id'=>$logement->id])}}">Afficher</a></td>
                </tbody>
            @endforeach
        </table>
    </div>

@endsection