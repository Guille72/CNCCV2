@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="container">
            {!! Form::open() !!}

            <div class="form-group">
                {!! Form::label('name', 'Nom') !!}
                {!! Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Nom']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('firstname', 'Prénom') !!}
                {!! Form::text('firstname', '', ['class' => 'form-control', 'placeholder' => 'Prénom']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('email', 'Mail') !!}
                {!! Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Mail']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('birthdate', 'Naissance') !!}
                {!! Form::date('birthdate', '', ['class' => 'form-control', 'placeholder' => 'Naissance']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('address', 'Adresse') !!}
                {!! Form::text('address', '', ['class' => 'form-control', 'placeholder' => 'Adresse']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('zip', 'Code postal') !!}
                {!! Form::text('zip', '', ['class' => 'form-control', 'placeholder' => 'Code postal']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('city', 'Ville') !!}
                {!! Form::text('city', '', ['class' => 'form-control', 'placeholder' => 'Ville']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('tel', 'Téléphone') !!}
                {!! Form::text('tel', '', ['class' => 'form-control', 'placeholder' => 'Téléphone']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('company', 'Entreprise (pour les professionnels)') !!}
                {!! Form::text('company', '', ['class' => 'form-control', 'placeholder' => 'Entreprise']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('siren', 'SIREN (pour les professionnels)') !!}
                {!! Form::text('siren', '', ['class' => 'form-control', 'placeholder' => 'SIREN']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('image', 'Carte d\'identité (jpg/png/pdf)') !!}
                {!! Form::file('image', '', ['class' => 'form-control', 'placeholder' => 'Carte d\'identité']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('tvaInt', 'TVA Int.') !!}
                {!! Form::text('tvaInt', '', ['class' => 'form-control', 'placeholder' => 'TVA Int.']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('password', 'Mot de passe') !!}
                {!! Form::password('password', '', ['class' => 'form-control', 'placeholder' => 'Mot de passe']) !!}
            </div>

            <button class="btn btn-success" type="submit">Ajouter !</button>
            {!! Form::close() !!}
        </div>
    </div>

@endsection