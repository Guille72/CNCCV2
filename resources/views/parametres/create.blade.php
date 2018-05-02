@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="container">
            {!! Form::open() !!}
            {!! Form::token(); !!}
            <div class="form-group">
                {!! Form::label('jourAnnul', 'Jours annulables') !!}
                {!! Form::date('jourAnnul', '', ['class' => 'form-control', 'placeholder' => 'Jours annulables']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('jourNonAnnul', 'Jours non annulables') !!}
                {!! Form::date('jourNonAnnul', '', ['class' => 'form-control', 'placeholder' => 'Jours non annulables']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('penalite', 'Pénalité') !!}
                {!! Form::text('penalite', '', ['class' => 'form-control', 'placeholder' => 'Pénalité']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('remiseSemaine', 'Remise semaine') !!}
                {!! Form::text('remiseSemaine', '', ['class' => 'form-control', 'placeholder' => 'Remise semaine']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('remiseMois', 'Remise mois') !!}
                {!! Form::text('remiseMois', '', ['class' => 'form-control', 'placeholder' => 'Remise mois']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('minFacture', 'Facture min.') !!}
                {!! Form::text('minFacture', '', ['class' => 'form-control', 'placeholder' => 'Facture min.']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('coefPerSupp', 'Coef. pers. supp.') !!}
                {!! Form::text('coefPerSupp', '', ['class' => 'form-control', 'placeholder' => 'Coef. pers. supp.']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('forfaitMenage', 'Forfait ménage') !!}
                {!! Form::text('forfaitMenage', '', ['class' => 'form-control', 'placeholder' => 'Forfait ménage']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('jourMenage', 'Jour ménage') !!}
                {!! Form::text('jourMenage', '', ['class' => 'form-control', 'placeholder' => 'Jour ménage']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('taxeSejour', 'Taxe séjour') !!}
                {!! Form::text('taxeSejour', '', ['class' => 'form-control', 'placeholder' => 'Taxe séjour']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('tva', 'TVA') !!}
                {!! Form::text('tva', '', ['class' => 'form-control', 'placeholder' => 'TVA']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('prixDef', 'Prix déf.') !!}
                {!! Form::text('prixDef', '', ['class' => 'form-control', 'placeholder' => 'Prix déf.']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('ville', 'Ville') !!}
                {!! Form::text('ville', '', ['class' => 'form-control', 'placeholder' => 'Ville']) !!}
            </div>

            <button class="btn btn-success" type="submit">Ajouter !</button>
            {!! Form::close() !!}
        </div>
    </div>

@endsection