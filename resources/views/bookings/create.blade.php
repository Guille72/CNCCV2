@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="container">
            {!! Form::open() !!}


            <div class="form-group">
                {!! Form::label('arrivee', 'Arrivée') !!}
                {!! Form::date('arrivee', '', ['class' => 'form-control', 'placeholder' => 'Arrivée']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('depart', 'Départ') !!}
                {!! Form::date('depart', '', ['class' => 'form-control', 'placeholder' => 'Départ']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('nbPers', 'Personnes') !!}
                {!! Form::text('nbPers', '', ['class' => 'form-control', 'placeholder' => 'Personnes']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('nbNuit', 'Nuits') !!}
                {!! Form::text('nbNuit', '', ['class' => 'form-control', 'placeholder' => 'Nuits']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('annulation', 'Annulation') !!}
                {!! Form::text('annulation', '', ['class' => 'form-control', 'placeholder' => 'Annulation']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('supplement', 'Supplément') !!}
                {!! Form::text('supplement', '', ['class' => 'form-control', 'placeholder' => 'Supplément']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('avoir', 'Avoir') !!}
                {!! Form::text('avoir', '', ['class' => 'form-control', 'placeholder' => 'Avoir']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('calendrierExt', 'Calendrier ext.') !!}
                {!! Form::text('calendrierExt', '', ['class' => 'form-control', 'placeholder' => 'Calendrier ext.']) !!}
            </div>

            <button class="btn btn-success" type="submit">Ajouter !</button>
            {!! Form::close() !!}
        </div>
    </div>

@endsection