    <form
        action="{{route('monsters.search')}}"
        method="GET"
        class="bg-gray-700 rounded-lg shadow-lg p-4 mb-6"
        >
        <h2 class="font-bold text-lg mb-4">Recherche</h2>
        <input
        type="text"
        name="texte"
        placeholder="Chercher un monstre..."
        class="w-full p-2 mb-4 bg-gray-800 rounded"
        />
        <button
        type="submit"
        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-full"
        >
        Chercher
        </button>
    </form>