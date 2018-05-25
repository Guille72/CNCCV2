@extends('layouts.layout')

@section('contenu')
    @include('cards.cardChampion')

<script>
    document.getElementById("navbar").classList.add("sticky");
</script>
@endsection
