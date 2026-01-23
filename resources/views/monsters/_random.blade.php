    <section class="mb-20">
        <div
        class="bg-gray-700 rounded-lg shadow-lg monster-card"
        data-monster-type="{{$randMonster->type->name}}"
        >
        <div class="md:flex">
            <!-- Image du monstre -->
            <div class="w-full md:w-1/2 relative">
            <img
                class="w-full h-full object-cover rounded-t-lg md:rounded-l-lg md:rounded-t-none"
                src="{{asset("images/{$randMonster->image_url}")}}"
                alt="{{$randMonster->name}}"
            />
            <div class="absolute top-4 right-4">
                <button
                class="text-white bg-gray-400 hover:bg-red-700 rounded-full p-2 transition-colors duration-300"
                style="
                    width: 40px;
                    height: 40px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                "
                >
                <i class="fa fa-bookmark"></i>
                </button>
            </div>
            </div>

            <!-- Détails du monstre -->
            <div class="p-6 md:w-1/2">
            <h2 class="text-3xl font-bold mb-2 creepster">
                {{$randMonster->name}}
            </h2>
            <p class="text-gray-300 text-sm mb-4">
                {{$randMonster->shortDescription()}}
            </p>
            <div class="mb-4">
                <strong class="text-white">Créateur:</strong>
                <span class="text-red-400">{{$randMonster->user->name}}</span>
            </div>
            <div class="mb-4">
                <div>
                <strong class="text-white">Type:</strong>
                <span class="text-gray-300">{{$randMonster->type->name}}</span>
                </div>
                <div>
                <strong class="text-white">PV:</strong>
                <span class="text-gray-300">{{$randMonster->pv}}</span>
                </div>
                <div>
                <strong class="text-white">Attaque:</strong>
                <span class="text-gray-300">{{$randMonster->attack}}</span>
                </div>
                <div>
                <strong class="text-white">Défense:</strong>
                <span class="text-gray-300">{{$randMonster->defense}}</span>
                </div>
            </div>
            <div class="mb-4">
                <span class="text-yellow-400">★★★★☆</span>
                <span class="text-gray-300 text-sm">(4.0/5.0)</span>
            </div>
            <div class="">
                <a
                href="{{route('monsters.show', ['monster' => $randMonster->id, 'slug' => $randMonster->slugify()])}}"
                class="inline-block text-white bg-red-500 hover:bg-red-700 rounded-full px-4 py-2 transition-colors duration-300"
                >Plus de détails</a
                >
            </div>
            </div>
        </div>
        </div>
    </section>