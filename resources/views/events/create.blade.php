@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="container">
            {!! Form::open() !!}
            {!! Form::token(); !!}
            <div class="form-group">
                {!! Form::label('dateDebut', 'Début') !!}
                {!! Form::date('dateDebut', \Carbon\Carbon::now(), ['class' => 'form-control', 'placeholder' => 'Début']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('dateFin', 'Fin') !!}
                {!! Form::date('dateFin', \Carbon\Carbon::now(), ['class' => 'form-control', 'placeholder' => 'Fin']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('prix', 'Prix') !!}
                {!! Form::text('prix', null, ['class' => 'form-control', 'placeholder' => 'Prix']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('evenement', 'Evènement') !!}
                {!! Form::text('evenement', null, ['class' => 'form-control', 'placeholder' => 'Evènement']) !!}
            </div>

            <button class="btn btn-success" type="submit">Ajouter !</button>
            {!! Form::close() !!}
        </div>
    </div>

@endsection