@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <a href="{{route('parametreCreate')}}">Ajout d'un paramètre</a>

        <table class="table">
            <thead>
            <tr>
                <td>ID</td>
                <td>Jours annulables</td>
                <td>Non annulables</td>
                <td>Pénalité</td>
                <td>Remise semaine</td>
                <td>Remise mois</td>
                <td>Facture min.</td>
                <td>Coef. pers. supp.</td>
                <td>Forfait ménage</td>
                <td>Jours ménage</td>
                <td>Taxe séjour</td>
                <td>TVA</td>
                <td>Prix déf.</td>
                <td>Ville</td>
                <td>Evènement prix</td>
                <td>Création</td>
                <td>Edition</td>
                <td>Action Editer</td>
                <td>Action Supprimer</td>
                <td>Action Affichage</td>
            </tr>
            </thead>
            @foreach($parametres as $parametre)
                <tbody>
                <td>{{$parametre->id}}</td>
                <td>{{$parametre->jourAnnul}}</td>
                <td>{{$parametre->jourNonAnnul}}</td>
                <td>{{$parametre->penalite}}</td>
                <td>{{$parametre->remiseSemaine}}</td>
                <td>{{$parametre->remiseMois}}</td>
                <td>{{$parametre->minFacture}}</td>
                <td>{{$parametre->coefPersSupp}}</td>
                <td>{{$parametre->forfaitMenage}}</td>
                <td>{{$parametre->jourMenage}}</td>
                <td>{{$parametre->taxeSejour}}</td>
                <td>{{$parametre->tva}}</td>
                <td>{{$parametre->prixDef}}</td>
                <td>{{$parametre->ville}}</td>

                @if(isset($parametre->event))
                    <td>{{$parametre->event->prix}}</td>
                @endif

                <td>{{$parametre->created_at}}</td>
                <td>{{$parametre->updated_at}}</td>
                <td><a class="btn btn-success" href="{{route('parmatreEdit', ['id'=>$parametre->id])}}">Edition</a></td>
                <td>{!! Form::open(['method' => 'DELETE','route' => ['parmatreDestroy', $parametre->id]]) !!}
                    {!! Form::token(); !!}
                    {!! Form::submit('Suppression', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}</td>
                <td><a class="btn btn-info" href="{{route('parmatreShow', ['id'=>$parametre->id])}}">Afficher</a></td>
                </tbody>
            @endforeach
        </table>
    </div>

@endsection