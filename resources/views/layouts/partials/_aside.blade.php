<aside class="w-full md:w-1/4 p-4">
<!-- Formulaire de Recherche Full Texte -->
    <form
    action="/recherche-texte"
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

<!-- Formulaire de Recherche par Critères -->
<form
    action="/recherche-criteres"
    method="GET"
    class="bg-gray-700 rounded-lg shadow-lg p-4"
>
    <h2 class="font-bold text-lg mb-4">Filtrer par Critères</h2>

    <!-- Type -->
    <select name="type" class="w-full p-2 mb-4 bg-gray-800 rounded">
    <option value="" disabled selected>Choisir un type</option>
    <option value="aquatique">Aquatique</option>
    <option value="terrestre">Terrestre</option>
    <option value="volant">Volant</option>
    <option value="cosmique">Cosmique</option>
    <option value="spectral">Spectral</option>
    </select>

    <!-- Rareté -->
    <select name="rarete" class="w-full p-2 mb-4 bg-gray-800 rounded">
    <option value="" disabled selected>Choisir une rareté</option>
    <option value="commun">Commun</option>
    <option value="rare">Rare</option>
    <option value="epique">Épique</option>
    <option value="legendaire">Légendaire</option>
    </select>

    <!-- PV -->
    <div class="bg-gray-700 rounded-lg shadow-lg p-4 mb-4">
    <h2 class="font-bold text-lg mb-4">Filtrer par PV</h2>
    <div id="slider-pv" class="mb-4"></div>
    <span id="slider-pv-value"></span>
    <input type="hidden" id="min-pv" name="min_pv" />
    <input type="hidden" id="max-pv" name="max_pv" />
    <script>
        var sliderPv = document.getElementById("slider-pv");
        var minPv = document.getElementById("min-pv");
        var maxPv = document.getElementById("max-pv");
        var sliderPvValue = document.getElementById("slider-pv-value");

        noUiSlider.create(sliderPv, {
        start: [20, 80], // Valeurs initiales pour min et max PV
        connect: true,
        range: {
            min: 0,
            max: 200,
        },
        });

        sliderPv.noUiSlider.on("update", function (values, handle) {
        minPv.value = values[0];
        maxPv.value = values[1];
        sliderPvValue.innerHTML = "PV: " + values.join(" - ");
        });
    </script>
    </div>

    <!-- Attaque -->
    <div class="bg-gray-700 rounded-lg shadow-lg p-4 mb-4">
    <h2 class="font-bold text-lg mb-4">Filtrer par Attaque</h2>
    <div id="slider-attaque" class="mb-4"></div>
    <span id="slider-attaque-value"></span>
    <input type="hidden" id="min-attaque" name="min_attaque" />
    <input type="hidden" id="max-attaque" name="max_attaque" />
    <script>
        var sliderAttaque = document.getElementById("slider-attaque");
        var minAttaque = document.getElementById("min-attaque");
        var maxAttaque = document.getElementById("max-attaque");
        var sliderAttaqueValue = document.getElementById(
        "slider-attaque-value"
        );

        noUiSlider.create(sliderAttaque, {
        start: [20, 80], // Valeurs initiales pour min et max Attaque
        connect: true,
        range: {
            min: 0,
            max: 200,
        },
        });

        sliderAttaque.noUiSlider.on("update", function (values, handle) {
        minAttaque.value = values[0];
        maxAttaque.value = values[1];
        sliderAttaqueValue.innerHTML = "Attaque: " + values.join(" - ");
        });
    </script>
    </div>

    <button
    type="submit"
    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-full"
    >
    Appliquer les filtres
    </button>
</form>
</aside>