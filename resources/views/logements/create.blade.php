@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="container">
            {!! Form::open() !!}
            {!! Form::token(); !!}
            <div class="form-group">
                {!! Form::label('name', 'Nom') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nom']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('address', 'Adresse') !!}
                {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Adresse']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('city', 'Ville') !!}
                {!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'Ville']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('localisation', 'Localisation') !!}
                {!! Form::text('localisation', null, ['class' => 'form-control', 'placeholder' => 'Localisation']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('surface', 'Surface') !!}
                {!! Form::text('surface', null, ['class' => 'form-control', 'placeholder' => 'Surface']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('type', 'Type') !!}
                {!! Form::text('type', null, ['class' => 'form-control', 'placeholder' => 'Type']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('bedroom', 'Chambres') !!}
                {!! Form::text('bedroom', null, ['class' => 'form-control', 'placeholder' => 'Chambres']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('coefPrix', 'Coef. prix') !!}
                {!! Form::text('coefPrix', null, ['class' => 'form-control', 'placeholder' => 'Coef. prix']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Description') !!}
                {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Description']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('image', 'Image') !!}
                {!! Form::text('image', null, ['class' => 'form-control', 'placeholder' => 'Image']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('persMax', 'Personnes max.') !!}
                {!! Form::text('persMax', null, ['class' => 'form-control', 'placeholder' => 'Personnes max.']) !!}
            </div>

            <button class="btn btn-success" type="submit">Ajouter !</button>
            {!! Form::close() !!}
        </div>
    </div>

@endsection