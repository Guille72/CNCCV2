@extends('layouts.layout')

@section('contenu')
    @include('layouts.navbar')
    @include('cards.cardChampion')
    @include('layouts.footer')
@endsection

<script>
    document.getElementById("navbar").classList.add("sticky");
</script>
