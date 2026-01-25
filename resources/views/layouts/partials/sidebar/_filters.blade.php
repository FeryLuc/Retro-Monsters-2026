<form
    action="{{route('monsters.filter')}}"
    method="GET"
    class="bg-gray-700 rounded-lg shadow-lg p-4"
>
    <h2 class="font-bold text-lg mb-4">Filtrer par Critères</h2>

    <!-- Type -->
    <select name="type" class="w-full p-2 mb-4 bg-gray-800 rounded">
    <option value="" disabled selected>Choisir un type</option>
    @foreach ($types as $type)
        <option value="{{$type->name}}">{{$type->name}}</option>
    @endforeach
    </select>

    <!-- Rareté -->
    <select name="rarete" class="w-full p-2 mb-4 bg-gray-800 rounded">
    <option value="" disabled selected>Choisir une rareté</option>
    @foreach ($rareties as $rarety)
        <option value="{{$rarety->name}}">{{$rarety->name}}</option>
    @endforeach
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
        step:1,
        format: {
            to: value => Math.round(value),
            from: value=>Number(value)
        }
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
        step:1,
        format:{
            to: value=>Math.round(value),
            from: value=>Number(value)
        }
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