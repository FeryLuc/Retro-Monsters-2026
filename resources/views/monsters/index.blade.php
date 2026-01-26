@extends('layouts.app')

@section('title')
    RetroMonsters - Liste des monstres
@endsection
@section('pageTitle')
    {{$title}}
@endsection
@section('content')
@include('monsters._latest', ['latestMonsters'=>$monsters])
            <div class="mt-10 flex justify-center">
            {{$monsters->withQueryString()->links()}}
        </div>
        {{-- Muavaise pratique - voir la publication de la pagination pour une customisation plus pro et controlée --}}
        <style>
            main div:first-of-type nav div.hidden {
                gap: 8px;
                flex-direction: column-reverse;
                align-items: center;
            }
            /* nav > div.hidden div:nth-of-type(2) span{
                background-color: blueviolet;
                color: white
            } */
        </style>
@endsection