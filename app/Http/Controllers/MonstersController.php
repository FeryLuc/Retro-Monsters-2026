<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Monster;
use App\Type;
use App\Rarety;
use App\User;
use Illuminate\Support\Str;

class MonstersController extends Controller
{
    public function index(){
        $monsters = Monster::orderBy('created_at', 'desc')->limit(9)->get();
        return view('monsters.index', compact('monsters'));
    }
    public function show(Monster $monster){
        return view('monsters.show', compact('monster'));
    }
    public function create(){
        $types = Type::get();
        $rareties = Rarety::get();
        $users= User::get();
        return view('monsters.create', compact('types', 'rareties', 'users'));
    }
   public function store(Request $request)
{
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
}
