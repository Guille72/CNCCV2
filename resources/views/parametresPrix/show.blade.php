@extends('layouts.app')
@section('content')

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
        </tr>
        </thead>
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

            <td>{{$booking->created_at}}</td>
            <td>{{$booking->updated_at}}</td>
            </tbody>
    </table>

@endsection