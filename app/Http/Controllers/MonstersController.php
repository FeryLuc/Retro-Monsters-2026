<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Monster;
use App\Type;
use App\Rarety;
use App\User;
use Illuminate\Support\Str;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class MonstersController extends Controller
{
    public function index(){
        $monsters = Monster::orderBy('created_at', 'desc')->paginate(9);
        $title = 'Liste des monstres';
        return view('monsters.index', compact('monsters', 'title'));
    }
    public function show(Monster $monster){
        return view('monsters.show', compact('monster'));
    }
    public function create(){
        $types = Type::get();
        $rareties = Rarety::get();
        $users = User::get();
        return view('monsters.create', compact('types', 'rareties', 'users'));
    }
    public function edit(Monster $monster){
        $types = Type::get();
        $rareties = Rarety::get();
        $users = User::get();
        return view('monsters.edit', compact('types', 'rareties', 'users', 'monster'));
    }
    public function update(Request $request, Monster $monster){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'pv' => 'required|integer|min:10|max:200',
            'attack' => 'required|integer|min:10|max:200',
            'defense' => 'required|integer|min:10|max:200',
            'type' => 'required|exists:monster_types,id',
            'rarety' => 'required|exists:rareties,id',
            'trainer' => 'required|exists:users,id',
            'image_url' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
        // Ajustement des noms de colonnes pour correspondre au fillable
        $validated['type_id'] = $validated['type'];
        unset($validated['type']);
        $validated['rarety_id'] = $validated['rarety'];
        unset($validated['rarety']);
        $validated['user_id'] = $validated['trainer']; 
        unset($validated['trainer']);

        //Upload image
        if ($request->hasFile('image_url')) {
            $oldUrl = $monster->getRawOriginal('image_url');

            if ($oldUrl && str_contains($oldUrl, 'cloudinary.com')) {
                $path = parse_url($oldUrl, PHP_URL_PATH);
                $publicId = pathinfo($path, PATHINFO_FILENAME);
                Cloudinary::destroy('monsters/'.$publicId);
            }

            $uploaded = Cloudinary::uploadFile($request->file('image_url')->getRealPath(), ['folder'=>'monsters']);

            $validated['image_url'] = $uploaded->getSecurePath();
        } else{
            unset($validated['image_url']);
        }

        $monster->update($validated);
        //with('clé','valeur') envoie des info a la session, des info "flash", qui n'existe plus après ouverture. on peut décidéer de les afficher garce a la methode session ddans les vues avec un petit if.
        return redirect()->route('monsters.show', ['monster'=>$monster->id ,'slug'=>$monster->slugify()])->with('success', 'Monstre modifié avec succès !');
    }
    public function store(Request $request){
        // Validation simple
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'pv' => 'required|integer|min:10|max:200',
            'attack' => 'required|integer|min:10|max:200',
            'defense' => 'required|integer|min:10|max:200',
            'type' => 'required|exists:monster_types,id',
            'rarety' => 'required|exists:rareties,id',
            'trainer' => 'required|exists:users,id',
            'image_url' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
        // Ajustement des noms de colonnes pour correspondre au fillable. Pour éviter ça changer les name des input pour correspondre au colonne de la db !!
        $validated['type_id'] = $validated['type'];
        unset($validated['type']);
        $validated['rarety_id'] = $validated['rarety'];
        unset($validated['rarety']);
        $validated['user_id'] = $validated['trainer']; 
        unset($validated['trainer']);

        //Upload image cloudinary
        if ($request->hasFile('image_url')) {
            $uploaded = Cloudinary::uploadFile(
                $request->file('image_url')->getRealPath(),
                ['folder'=>'monsters']
            );

            $validated['image_url'] = $uploaded->getSecurePath();
        }

        // Création du monstre
        Monster::create($validated);

        //Redirection
        return redirect()->route('monsters.index')
                        ->with('success', 'Monstre ajouté avec succès !');
    }
    public function destroy(Monster $monster){
        $oldUrl = $monster->getRawOriginal('image_url');
        if ($oldUrl && str_contains($oldUrl, 'cloudinary.com')) {
           $path = parse_url($oldUrl, PHP_URL_PATH);
           $publicId = pathinfo($path, PATHINFO_FILENAME);
            Cloudinary::destroy('monsters/'. $publicId);
        }
        $monster->delete();

        return redirect()->route('monsters.index')->with('success', 'Monstre supprimé !');
    }
    public function search(Request $request){
        $request->validate([
            'texte' => 'nullable|string|max:255',
        ]);
        //instance vide pour pouvoir ajouter des filtre optionnels et envoyer plus tard a la vue.
        $query = Monster::query();

        if($request->filled('texte')){
            $search = $request->texte;

            $words =preg_split('/\s+/', $search, -1, PREG_SPLIT_NO_EMPTY);
            //Closure => fonction anonyme permettant l'import de variables externe en php.
            //Grace à l'index mes requete sql se construire en OR et non en AND !!
            $query->where(function ($q) use($words){
                foreach ($words as $index => $word) {
                    if ($index === 0) {
                        $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($word) . '%'])
                        ->orWhereRaw('LOWER(description) LIKE ?', ['%' . strtolower($word) . '%']);
                    } else {
                        $q->orWhereRaw('LOWER(name) LIKE ?', ['%' . strtolower($word) . '%'])
                        ->orWhereRaw('LOWER(description) LIKE ?', ['%' . strtolower($word) . '%']);
                    }
                }
            });
        }
        $monsters = $query->paginate(9);
        $title = 'Résultat de votre recherche';
        return view('monsters.index', compact('monsters', 'title'));
    }
    public function filter(Request $request){
        $request->validate([
            'type' => 'nullable|string',
            'rarete' => 'nullable|string',
            'min_pv' => 'nullable|integer',
            'max_pv' => 'nullable|integer',
            'min_attaque' => 'nullable|integer',
            'max_attaque' => 'nullable|integer',
        ]);

        $query = Monster::query();
        // Définir les filtres et leur callback
        $filters = [
            'type' => fn($q, $value) => $q->whereHas('type', fn($m) => $m->where('name', $value)),
            'rarete' => fn($q, $value) => $q->whereHas('rarety', fn($m) => $m->where('name', $value)),
            'min_pv' => fn($q, $value) => $q->where('pv', '>=', (int)$value),
            'max_pv' => fn($q, $value) => $q->where('pv', '<=', (int)$value),
            'min_attaque' => fn($q, $value) => $q->where('attack', '>=', (int)$value),
            'max_attaque' => fn($q, $value) => $q->where('attack', '<=', (int)$value),
        ];

        // Appliquer les filtres si présents dans la requête
        foreach ($filters as $key => $callback) {
            if ($request->filled($key)) {
                $callback($query, $request->$key);
            }
        }

        $monsters = $query->paginate(9);
        $title = 'Résultat du filtrage';
        return view('monsters.index', compact('monsters', 'title'));
    }
}
