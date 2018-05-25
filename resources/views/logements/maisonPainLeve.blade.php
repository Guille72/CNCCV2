@extends('layouts.layout')

@section('contenu')
    @include('layouts.navbar')
    @include('cards.cardPainLeve')
    @include('layouts.footer')

    <script>
        document.getElementById("navbar").classList.add("sticky");
    </script>

@endsection
