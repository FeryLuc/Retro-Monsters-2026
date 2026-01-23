@extends('layouts.app')

@section('title')
    RetroMonsters - Ajout d'un monstre
@endsection

@section('content')
        <div class="container mx-auto pb-12">
          <div class="flex flex-wrap justify-center">
            <div class="w-full">
              <div class="bg-gray-700 p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-4 text-center creepster">
                  Ajouter un monstre
                </h2>
                <form class="space-y-6">
                  <div>
                    <label for="name" class="block mb-1">Nom</label>
                    <input
                      type="text"
                      id="name"
                      class="w-full border rounded px-3 py-2 text-gray-700"
                      placeholder="Nom du Monstre"
                    />
                  </div>
                  <div>Ajoutez ici les autres champs...</div>
                  <div class="flex justify-between items-center">
                    <button
                      type="submit"
                      class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                    >
                      Ajouter
                    </button>
                    <button
                      type="reset"
                      class="text-red-400 hover:text-red-500"
                    >
                      Annuler
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
@endsection