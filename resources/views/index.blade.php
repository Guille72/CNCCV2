@extends('layouts.layout')
<img class="responsive-img" src="{{asset('img/PanoramaLeMans.JPG')}}">

@section('contenu')
    @include('layouts.presentation')
    @include('cards.cardPage')
@endsection
