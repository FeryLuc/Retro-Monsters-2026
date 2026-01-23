<nav
class="container mx-auto px-4 py-4 mb-16 flex justify-between items-center">
<div class="flex items-center">
    <a href="#">
    <img
        src="{{asset("images/Logo_RetroMonsters.png")}}"
        alt="RetroMonsters Logo"
        class="h-32 mr-3 absolute"
        style="top: -28px"
    />
    </a>
    <a href="#" class="text-white font-bold text-xl hidden"
    >RetroMonsters</a
    >
</div>

<button @click="open = !open" class="text-white md:hidden">
    <i class="fa fa-bars"></i>
</button>

<div class="hidden md:flex items-center">
    <a
    class="text-gray-300 hover:text-white px-3 py-2 hover:bg-gray-700"
    href="#"
    >Monstres</a
    >
    <a
    class="text-gray-300 hover:text-white px-3 py-2 hover:bg-gray-700 active"
    href="#"
    >Ajouter un monstre</a
    >
    <!-- <a
    class="text-gray-300 hover:text-white px-3 py-2 hover:bg-gray-700"
    href="#"
    >Créateurs</a
    > -->
    <!-- <a
    class="text-gray-300 hover:text-white px-3 py-2 hover:bg-gray-700"
    href="#"
    >Se connecter</a
    > -->

    <!-- Utilisation d'un bouton pour ouvrir le menu déroulant de l'utilisateur -->
    <!-- <div class="relative" x-data="{ userMenuOpen: false }">
    <button @click="userMenuOpen = !userMenuOpen" class="text-white">
        <img src="images/user.webp" alt="" class="w-16" />
    </button>

    <div
        x-show="userMenuOpen"
        @click.away="userMenuOpen = false"
        class="absolute right-0 mt-2 w-48 bg-gray-100 rounded-md shadow-lg pb-1 z-50"
    >
        <div class="text-gray-200 px-4 py-2 bg-gray-400 text-center">
        Username
        </div>
        <a
        href="#"
        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200"
        >Mon Profil</a
        >
        <a
        href="#"
        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200"
        >Mon Deck</a
        >
        <a
        href="#"
        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200"
        >Ajouter un Monstre</a
        >
        <a
        href="#"
        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200"
        >Se Déconnecter</a
        >
    </div>
    </div> -->
</div>
</nav>