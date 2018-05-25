@extends('layouts.layout')
<img class="responsive-img" src="{{asset('img/PanoramaLeMans.JPG')}}">

@section('contenu')
    @include('layouts.navbar')
    @include('layouts.presentation')
    @include('cards.cardPage')
    @include('layouts.footer')
@endsection
