@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="container">
            {!! Form::model($note) !!}

            <div class="form-group">
                {!! Form::label('proprete', 'Propreté') !!}
                {!! Form::date('proprete', '', ['class' => 'form-control', 'placeholder' => 'Propreté']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('accueil', 'Accueil') !!}
                {!! Form::date('accueil', '', ['class' => 'form-control', 'placeholder' => 'Accueil']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('confort', 'Confort') !!}
                {!! Form::text('confort', '', ['class' => 'form-control', 'placeholder' => 'Confort']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('etoile', 'Etoile') !!}
                {!! Form::text('etoile', '', ['class' => 'form-control', 'placeholder' => 'Etoile']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('global', 'Global') !!}
                {!! Form::text('global', '', ['class' => 'form-control', 'placeholder' => 'Global']) !!}
            </div>

            {!! Form::open(['method' => 'PUT', 'route'=> ['noteEdit', $note]]) !!}
            {{ Form::submit('Edition', ['class' => 'btn btn-info'])}}
            {!! Form::close() !!}
        </div>
    </div>

@endsection