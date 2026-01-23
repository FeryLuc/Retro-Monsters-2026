<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Monster;

class HomeController extends Controller
{
    public function home(){
        $randMonster = Monster::inRandomOrder()->first();
        $latestMonsters = Monster::orderBy('created_at', 'desc')->limit(3)->get();
        return view('pages.home', compact('randMonster', 'latestMonsters'));
    }
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // /**
    //  * Show the application dashboard.
    //  *
    //  * @return \Illuminate\Contracts\Support\Renderable
    //  */
    // public function index()
    // {
    //     return view('home');
    // }
}
