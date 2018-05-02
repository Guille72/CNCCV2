@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="container">
            {!! Form::model($parametre) !!}
            
            <div class="form-group">
                {!! Form::label('jourAnnul', 'Jours annulables') !!}
                {!! Form::date('jourAnnul', null, ['class' => 'form-control', 'placeholder' => 'Jours annulables']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('jourNonAnnul', 'Jours non annulables') !!}
                {!! Form::date('jourNonAnnul', null, ['class' => 'form-control', 'placeholder' => 'Jours non annulables']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('penalite', 'Pénalité') !!}
                {!! Form::text('penalite', null, ['class' => 'form-control', 'placeholder' => 'Pénalité']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('remiseSemaine', 'Remise semaine') !!}
                {!! Form::text('remiseSemaine', null, ['class' => 'form-control', 'placeholder' => 'Remise semaine']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('remiseMois', 'Remise mois') !!}
                {!! Form::text('remiseMois', null, ['class' => 'form-control', 'placeholder' => 'Remise mois']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('minFacture', 'Facture min.') !!}
                {!! Form::text('minFacture', null, ['class' => 'form-control', 'placeholder' => 'Facture min.']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('coefPerSupp', 'Coef. pers. supp.') !!}
                {!! Form::text('coefPerSupp', null, ['class' => 'form-control', 'placeholder' => 'Coef. pers. supp.']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('forfaitMenage', 'Forfait ménage') !!}
                {!! Form::text('forfaitMenage', null, ['class' => 'form-control', 'placeholder' => 'Forfait ménage']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('jourMenage', 'Jour ménage') !!}
                {!! Form::text('jourMenage', null, ['class' => 'form-control', 'placeholder' => 'Jour ménage']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('taxeSejour', 'Taxe séjour') !!}
                {!! Form::text('taxeSejour', null, ['class' => 'form-control', 'placeholder' => 'Taxe séjour']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('tva', 'TVA') !!}
                {!! Form::text('tva', null, ['class' => 'form-control', 'placeholder' => 'TVA']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('prixDef', 'Prix déf.') !!}
                {!! Form::text('prixDef', null, ['class' => 'form-control', 'placeholder' => 'Prix déf.']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('ville', 'Ville') !!}
                {!! Form::text('ville', null, ['class' => 'form-control', 'placeholder' => 'Ville']) !!}
            </div>

            {!! Form::open(['method' => 'PUT', 'route'=> ['parametreEdit', $parametre]) !!}
            {!! Form::token(); !!}
            {{ Form::submit('Edition', ['class' => 'btn btn-info'])}}
            {!! Form::close() !!}
        </div>
    </div>

@endsection