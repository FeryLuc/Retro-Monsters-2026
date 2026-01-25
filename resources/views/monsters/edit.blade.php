@extends('layouts.app')

@section('title')
    RetroMonsters - Modification
@endsection

@section('content')
        <div class="container mx-auto pb-12">
          <div class="flex flex-wrap justify-center">
            <div class="w-full">
              <div class="bg-gray-700 p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-4 text-center creepster">
                  Modifier le monstre
                </h2>
                <form class="space-y-6" action="{{route('monsters.update', ['monster'=>$monster->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-col gap-6 md:flex-row">
                        <div class="flex-1 self-center">
                            <img src="{{$monster->image_url}}" alt="{{$monster->name}}" class="w-full h-auto rounded-xl object-cover">
                        </div>
                        <div class="flex flex-col flex-[2] justify-between gap-6">
                            <div>
                                <label for="name" class="block mb-1">Nom</label>
                                <input
                                required
                                type="text"
                                name="name"
                                id="name"
                                class="w-full border rounded px-3 py-2 text-gray-700"
                                placeholder="Nom du Monstre"
                                value="{{old('name', $monster->name)}}"
                                />
                            </div>
                            <div>
                                <label for="description" class="block mb-1">description</label>
                                <textarea
                                required
                                type="text"
                                name="description"
                                rows="10"
                                id="description"
                                class="w-full border rounded px-3 py-2 text-gray-700 resize-none"
                                placeholder="Description de votre monstre"
                                >{{old('description', $monster->description)}}</textarea>
                            </div>
                            <div class="flex justify-between gap-8">
                                <div class="flex-1">
                                    <label for="pv" class="block mb-1">PV</label>
                                    <input required value="{{old('pv', $monster->pv)}}" type="number" name="pv" id="pv" min="10" max="200" class="text-gray-700 border rounded px-3 py-2">
                                </div>
                                <div class="flex-1">
                                    <label for="attack" class="block mb-1">Attack</label>
                                    <input required value="{{old('attack', $monster->attack)}}" type="number" name="attack" id="attack" min="10" max="200" class="text-gray-700 border rounded px-3 py-2">
                                </div>
                                <div class="flex-1">
                                    <label for="defense" class="block mb-1">Defense</label>
                                    <input required value="{{old('defense', $monster->defense)}}" type="number" name="defense" id="defense" min="10" max="200" class="text-gray-700 border rounded px-3 py-2">
                                </div>
                                <button id="stats-generator" class="flex-1 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Générer</button>
                            </div>
                        </div>
                    </div>



                    <div class="flex gap-8">
                        <div class="flex-1">
                            <label for="type" class="block mb-1">Type</label>
                            <select required name="type" id="type" class="w-full border rounded px-3 py-2 text-gray-700">
                                <option selected>Choisissez un type</option>
                                @foreach ($types as $type)
                                    <option {{$monster->type_id === $type->id ? 'selected' : ''}} value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex-1">
                            <label for="rarety" class="block mb-1">Rareté</label>
                            <select required name="rarety" id="rarety" class="w-full border rounded px-3 py-2 text-gray-700">
                                <option selected>Choisissez une rareté</option>
                                @foreach ($rareties as $rarety)
                                    <option {{$monster->rarety_id === $rarety->id ? 'selected' : ''}} value="{{$rarety->id}}">{{$rarety->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex-1">
                            <label for="trainer" class="block mb-1">Trainer</label>
                            <select required name="trainer" id="trainer" class="w-full border rounded px-3 py-2 text-gray-700">
                                <option selected>Choisissez un entraineur</option>
                                @foreach ($users as $user)
                                    <option {{$monster->user_id === $user->id ? 'selected' : ''}} value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                   
                    <div>
                        <label for="image" class="block mb-1">Upload d'une image</label>
                        <input type="file" name="image_url" id="image" accept="image/*" class="w-1/2 border rounded px-3 py-2">
                    </div>

                 
                
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