@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="container">
            {!! Form::model($event) !!}

            <div class="form-group">
                {!! Form::label('dateDebut', 'Début') !!}
                {!! Form::date('dateDebut', \Carbon\Carbon::class, ['class' => 'form-control', 'placeholder' => 'Début']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('dateFin', 'Fin') !!}
                {!! Form::date('dateFin', \Carbon\Carbon::class, ['class' => 'form-control', 'placeholder' => 'Fin']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('prix', 'Prix') !!}
                {!! Form::text('prix', null, ['class' => 'form-control', 'placeholder' => 'Prix']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('evenement', 'Evènement') !!}
                {!! Form::text('evenement', null, ['class' => 'form-control', 'placeholder' => 'Evènement']) !!}
            </div>

            {!! Form::open(['method' => 'PUT', 'route'=> ['eventEdit', $event]]) !!}
            {!! Form::token(); !!}
            {{ Form::submit('Edition', ['class' => 'btn btn-info'])}}
            {!! Form::close() !!}
        </div>
    </div>

@endsection