@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="container">
            {!! Form::model($logement) !!}

            <div class="form-group">
                {!! Form::label('name', 'Nom') !!}
                {!! Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Nom']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('address', 'Adresse') !!}
                {!! Form::text('address', '', ['class' => 'form-control', 'placeholder' => 'Adresse']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('city', 'Ville') !!}
                {!! Form::text('city', '', ['class' => 'form-control', 'placeholder' => 'Ville']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('localisation', 'Localisation') !!}
                {!! Form::text('localisation', '', ['class' => 'form-control', 'placeholder' => 'Localisation']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('surface', 'Surface') !!}
                {!! Form::text('surface', '', ['class' => 'form-control', 'placeholder' => 'Surface']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('type', 'Type') !!}
                {!! Form::text('type', '', ['class' => 'form-control', 'placeholder' => 'Type']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('bedroom', 'Chambres') !!}
                {!! Form::text('bedroom', '', ['class' => 'form-control', 'placeholder' => 'Chambres']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('coefPrix', 'Coef. prix') !!}
                {!! Form::text('coefPrix', '', ['class' => 'form-control', 'placeholder' => 'Coef. prix']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Description') !!}
                {!! Form::text('description', '', ['class' => 'form-control', 'placeholder' => 'Description']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('image', 'Image') !!}
                {!! Form::text('image', '', ['class' => 'form-control', 'placeholder' => 'Image']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('persMax', 'Personnes max.') !!}
                {!! Form::text('persMax', '', ['class' => 'form-control', 'placeholder' => 'Personnes max.']) !!}
            </div>

            {!! Form::open(['method' => 'PUT', 'route'=> ['logementEdit', $logement]]) !!}
            {{ Form::submit('Edition', ['class' => 'btn btn-info'])}}
            {!! Form::close() !!}
        </div>
    </div>

@endsection