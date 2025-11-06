<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Films extends Controller
{
    public function films(){
        $films = FilmServices::getFilmsData();
        return view('films.films', [
            'films' => $films,
            'selected_genre' => 'All'
        ]);
    }

    public function genre($pick){
        $filtered_films = FilmServices::getFilmsData();
        $pick = ucfirst($pick);
        foreach($filtered_films as $key => $film){
            if(!in_array($pick, $film['genre'])){
                unset($filtered_films[$key]);
            }
        }

        return view('films.films', [
            'films' => $filtered_films,
            'selected_genre' => $pick
        ]);
    }

    public function movies(){
        $all_films = FilmServices::getFilmsData();
        $movies = [];
        foreach($all_films as $key => $film){
            if($film['type'] === 'Movie'){
                $movies[] = $film;
            }
        }
        return view('films.movies', [
            'films' => $movies,
            'selected_genre' => 'All'
        ]);
    }

    public function filter_movies($pick){
        $all_films = FilmServices::getFilmsData();
        $movies = [];
        $pick = ucfirst($pick);
        foreach($all_films as $key => $film){
            if($film['type'] === 'Movie' && in_array($pick, $film['genre'])){
                $movies[] = $film;
            }
        }
        return view('films.movies', [
            'films' => $movies,
            'selected_genre' => $pick
        ]);
    }

    public function series(){
        $all_films = FilmServices::getFilmsData();
        $serial = [];
        foreach($all_films as $key => $film){
            if($film['type'] === 'Serial'){
                $serial[] = $film;
            }
        }

        return view('films.serial', [
            'films' => $serial,
            'selected_genre' => 'All'
        ]);
    }

    public function filter_serial($pick){
        $all_films = FilmServices::getFilmsData();
        $serial = [];
        $pick = ucfirst($pick);
        foreach($all_films as $key => $film){
            if($film['type'] === 'Serial' && in_array($pick, $film['genre'])){
                $serial[] = $film;
            }
        }

        return view('films.serial', [
            'films' => $serial,
            'selected_genre' => $pick
        ]);
    }

}
