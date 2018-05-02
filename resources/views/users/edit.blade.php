@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="container">
            {!! Form::model($user) !!}

            <div class="form-group">
                {!! Form::label('name', 'Nom') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nom']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('firstname', 'Prénom') !!}
                {!! Form::text('firstname', null, ['class' => 'form-control', 'placeholder' => 'Prénom']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('email', 'Mail') !!}
                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Mail']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('birthdate', 'Naissance') !!}
                {!! Form::date('birthdate', \Carbon\Carbon::class, ['class' => 'form-control', 'placeholder' => 'Naissance']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('address', 'Adresse') !!}
                {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Adresse']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('zip', 'Code postal') !!}
                {!! Form::text('zip', null, ['class' => 'form-control', 'placeholder' => 'Code postal']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('city', 'Ville') !!}
                {!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'Ville']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('tel', 'Téléphone') !!}
                {!! Form::text('tel', null, ['class' => 'form-control', 'placeholder' => 'Téléphone']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('company', 'Entreprise (pour les professionnels)') !!}
                {!! Form::text('company', null, ['class' => 'form-control', 'placeholder' => 'Entreprise']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('siren', 'SIREN (pour les professionnels)') !!}
                {!! Form::text('siren', null, ['class' => 'form-control', 'placeholder' => 'SIREN']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('image', 'Carte d\'identité (jpg/png/pdf)') !!}
                {!! Form::file('image', null, ['class' => 'form-control', 'placeholder' => 'Carte d\'identité']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('tvaInt', 'TVA Int.') !!}
                {!! Form::text('tvaInt', null, ['class' => 'form-control', 'placeholder' => 'TVA Int.']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('password', 'Mot de passe') !!}
                {!! Form::password('password', null, ['class' => 'form-control', 'placeholder' => 'Mot de passe']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('role', 'Rôle') !!}
                {!! Form::select('role', ['member' => 'member', 'admin' => 'admin']) !!}
            </div>

            {!! Form::open(['method' => 'PUT', 'route'=> ['userEdit', $user]]) !!}
            {!! Form::token(); !!}
            {{ Form::submit('Edition', ['class' => 'btn btn-info'])}}
            {!! Form::close() !!}
        </div>
    </div>

@endsection