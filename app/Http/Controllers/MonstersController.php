<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Monster;
use App\Type;
use App\Rarety;
use App\User;
use Illuminate\Support\Str;

class MonstersController extends Controller
{
    public function index(){
        $monsters = Monster::orderBy('created_at', 'desc')->paginate(9);
        return view('monsters.index', compact('monsters'));
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
            // Supprimer l’ancienne image si elle existe
            $oldImagePath = $monster->getRawOriginal('image_url');
            if ($oldImagePath && Storage::disk('public')->exists($oldImagePath)) {
                Storage::disk('public')->delete($oldImagePath);
            }
            $file = $request->file('image_url');
            $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                        . '-' . time() 
                        . '.' . $file->getClientOriginalExtension();

            // stocke dans storage/app/public/monsters
            $path = $file->storeAs('monsters', $filename, 'public');

            $validated['image_url'] = $path;
        } else{
            //Supprime la prop image_url du validate pour garder l'ancienne image sinon null sera stocké et écrasera l'ancienne image.
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

        //Upload image
        if ($request->hasFile('image_url')) {
            $file = $request->file('image_url');

            $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                        . '-' . time() 
                        . '.' . $file->getClientOriginalExtension();

            // stocke dans storage/app/public/monsters
            $path = $file->storeAs('monsters', $filename, 'public');

            $validated['image_url'] = $path;
        }

        // Ajustement des noms de colonnes pour correspondre au fillable
        $validated['type_id'] = $validated['type'];
        unset($validated['type']);

        $validated['rarety_id'] = $validated['rarety'];
        unset($validated['rarety']);

        $validated['user_id'] = $validated['trainer']; 
        unset($validated['trainer']);

        // Création du monstre
        Monster::create($validated);

        //Redirection
        return redirect()->route('monsters.index')
                        ->with('success', 'Monstre ajouté avec succès !');
    }
    public function destroy(Monster $monster){
        
        if ($monster->getRawOriginal('image_url')) {
            Storage::disk('public')->delete($monster->getRawOriginal('image_url'));
        }
        $monster->delete();

        return redirect()->route('monsters.index')->with('success', 'Monstre supprimé');
    }
    public function search(Request $request){
        $request->validate([
            'texte' => 'nullable|string|max:255',
        ]);
        //instance vide pour pouvoir ajouter des filtre optionnels et envoyer plus tard a la vue.
        $query = Monster::query();

        if($request->filled('texte')){
            $search = $request->texte;

            $query->where(function ($m) use($search){
                $m->where('name', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }
        $monsters = $query->paginate(9);
        return view('monsters.index', compact('monsters'));
    }
}
