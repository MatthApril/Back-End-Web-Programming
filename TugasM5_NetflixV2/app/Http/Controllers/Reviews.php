<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Reviews extends Controller
{
    public function reviews(){
        $films_with_reviews = FilmServices::getFilmsWithReviews();
        $all_reviews = FilmServices::getReviewsData();

        return view('reviews.reviews', [
            'films' => $films_with_reviews,
            'total_reviews' => count($all_reviews),
            'selected_filter' => 'all'
        ]);
    }

    public function topReviewed(){
        $films_with_reviews = FilmServices::getFilmsWithReviews();

        $max = 0;
        $top_film = null;
        foreach ($films_with_reviews as $film) {
            if (count($film['reviews']) > $max) {
                $max = count($film['reviews']);
                $top_film = $film;
            }
        }

        return view('reviews.reviews', [
            'top_film' => $top_film,
            'total_reviews' => $max,
            'selected_filter' => 'top',
        ]);
    }

    public function fiveStars(){
            $films_with_reviews = FilmServices::getFilmsWithReviews();
            $reviewCount = 0;

            $films_with_five_star_reviews = [];

            foreach ($films_with_reviews as $film) {
                if ($film['rating'] > 4) {
                    $films_with_five_star_reviews[] = $film;
                    $reviewCount += count($film['reviews']);
                }
            }
            return view('reviews.reviews', [
                'films' => $films_with_five_star_reviews,
                'total_reviews' => $reviewCount,
                'selected_filter' => 'five_stars'
            ]);
        }

    public function fourStars(){
        $films_with_reviews = FilmServices::getFilmsWithReviews();
        $reviewCount = 0;

        $films_with_four_star_reviews = [];

        foreach ($films_with_reviews as $film) {
            if ($film['rating'] >= 3 && $film['rating'] <= 4) {
                $films_with_four_star_reviews[] = $film;
                $reviewCount += count($film['reviews']);
            }
        }
        return view('reviews.reviews', [
            'films' => $films_with_four_star_reviews,
            'total_reviews' => $reviewCount,
            'selected_filter' => 'four_stars'
        ]);
    }

    public function threeStars(){
        $films_with_reviews = FilmServices::getFilmsWithReviews();
        $reviewCount = 0;

        $films_with_three_star_reviews = [];

        foreach ($films_with_reviews as $film) {
            if ($film['rating'] < 3) {
                $films_with_three_star_reviews[] = $film;
                $reviewCount += count($film['reviews']);
            }
        }
        return view('reviews.reviews', [
            'films' => $films_with_three_star_reviews,
            'total_reviews' => $reviewCount,
            'selected_filter' => 'three_stars'
        ]);
    }
}
