@extends('layouts.layout')

@section('contenu')
    @include('cards.cardPainLeve')

    <script>
        document.getElementById("navbar").classList.add("sticky");
    </script>

@endsection
