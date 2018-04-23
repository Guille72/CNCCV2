@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="container">
            {!! Form::model($event) !!}

            <div class="form-group">
                {!! Form::label('dateDebut', 'Début') !!}
                {!! Form::date('dateDebut', '', ['class' => 'form-control', 'placeholder' => 'Début']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('dateFin', 'Fin') !!}
                {!! Form::date('dateFin', '', ['class' => 'form-control', 'placeholder' => 'Fin']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('prix', 'Prix') !!}
                {!! Form::text('prix', '', ['class' => 'form-control', 'placeholder' => 'Prix']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('evenement', 'Evènement') !!}
                {!! Form::text('evenement', '', ['class' => 'form-control', 'placeholder' => 'Evènement']) !!}
            </div>

            {!! Form::open(['method' => 'PUT', 'route'=> ['eventEdit', $event]]) !!}
            {{ Form::submit('Edition', ['class' => 'btn btn-info'])}}
            {!! Form::close() !!}
        </div>
    </div>

@endsection