@extends('layouts.app')

@section('title')
    RetroMonsters
@endsection

@section('content')
    <!-- Section Monstre Aléatoire -->
    @include('monsters._random')

    <!-- Section Derniers monstres -->
    @include('monsters._latest')
@endsection