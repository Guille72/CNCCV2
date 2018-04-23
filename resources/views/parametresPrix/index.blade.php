@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <a href="{{route('parametrePrixCreate')}}">Ajout d'un paramètre</a>

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
            @foreach($parametresPrix as $parametrePrix)
                <tbody>
                <td>{{$parametrePrix->id}}</td>
                <td>{{$parametrePrix->jourAnnul}}</td>
                <td>{{$parametrePrix->jourNonAnnul}}</td>
                <td>{{$parametrePrix->penalite}}</td>
                <td>{{$parametrePrix->remiseSemaine}}</td>
                <td>{{$parametrePrix->remiseMois}}</td>
                <td>{{$parametrePrix->minFacture}}</td>
                <td>{{$parametrePrix->coefPersSupp}}</td>
                <td>{{$parametrePrix->forfaitMenage}}</td>
                <td>{{$parametrePrix->jourMenage}}</td>
                <td>{{$parametrePrix->taxeSejour}}</td>
                <td>{{$parametrePrix->tva}}</td>
                <td>{{$parametrePrix->prixDef}}</td>
                <td>{{$parametrePrix->ville}}</td>

                @if(isset($parametrePrix->event))
                    <td>{{$parametrePrix->event->prix}}</td>
                @endif

                <td>{{$parametrePrix->created_at}}</td>
                <td>{{$parametrePrix->updated_at}}</td>
                <td><a class="btn btn-success" href="{{route('parmatrePrixEdit', ['id'=>$parmatrePrix->id])}}">Edition</a></td>
                <td>{!! Form::open(['method' => 'DELETE','route' => ['parmatrePrixDestroy', $parmatrePrix->id]]) !!}
                    {!! Form::submit('Suppression', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}</td>
                <td><a class="btn btn-info" href="{{route('parmatrePrixShow', ['id'=>$parmatrePrix->id])}}">Afficher</a></td>
                </tbody>
            @endforeach
        </table>
    </div>

@endsection