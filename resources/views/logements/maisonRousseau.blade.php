@extends('layouts.layout')

@section('contenu')
    @include('cards.cardRousseau')

    <script>
        document.getElementById("navbar").classList.add("sticky");
    </script>

@endsection
