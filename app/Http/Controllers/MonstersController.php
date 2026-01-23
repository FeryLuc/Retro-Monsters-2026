<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Monster;

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
        return view('monsters.create');
    }
}
