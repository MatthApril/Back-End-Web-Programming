<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function show($id){
        require public_path('data_tugas.php');

        $temp = array_filter($pokemons, fn($pokemon) => $pokemon['id'] == $id);

        $pokemon = array_values($temp)[0];
        // dd($pokemon);
        return view('pages.pokemon.show', ['pokemon' => $pokemon]);
    }

    public function index($type){
        require public_path('data_tugas.php');

        $type = ucfirst($type);

        if ($type != 'All') {
            $pokemons = array_filter($pokemons, fn($pokemon) => $pokemon['primary'] == $type || $pokemon['secondary'] == $type);

            $pokemons = array_values($pokemons);
        }

        return view('pages.pokemon.index', ['pokemons' => $pokemons]);
    }
}
