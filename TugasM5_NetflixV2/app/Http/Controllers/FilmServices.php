<?php

namespace App\Http\Controllers;

class FilmServices
{
    public static function getFilmsData(){
        return [
            [
                "id" => 1,
                "title" => "KPop Demon Hunters",
                "release_year" => "2025",
                "age_rating" => "13+",
                "genre" => ["Musik", "Keluarga", "Komedi"],
                "type" => "Movie",
                "image" => "https://m.media-amazon.com/images/M/MV5BNTBiYWJlMjQtOTIyMy00NTY4LWFhOWItOWZhNzc3NGMyMjc2XkEyXkFqcGc@._V1_.jpg",
                "cast" => [
                    ["name" => "Arden Cho", "role" => "Rumi"],
                    ["name" => "Ahn Hyo-seop", "role" => "Jinu"]
                ],
                "rating" => 4.5,
                "languages" => ["Korean", "English"],
                "duration" => 120
            ],
            [
                "id" => 2,
                "title" => "The Exorcist: Believer",
                "release_year" => "2023",
                "age_rating" => "17+",
                "genre" => ["Horror", "Thriller"],
                "type" => "Movie",
                "image" => "https://sparxentertainment.com/wp-content/uploads/2023/07/screen_shot_2023-07-20_at_11.45.41_am.png",
                "cast" => [
                    ["name" => "Ellen Burstyn", "role" => "Chris MacNeil"],
                    ["name" => "Leslie Odom Jr.", "role" => "Victor Fielding"]
                ],
                "rating" => 4,
                "languages" => ["English"],
                "duration" => 110,
            ],
            [
                "id" => 3,
                "title" => "Spirited Away",
                "release_year" => "2001",
                "age_rating" => "13+",
                "genre" => ["Animasi", "Petualangan", "Fantasi"],
                "type" => "Movie",
                "image" => "https://m.media-amazon.com/images/M/MV5BNTEyNmEwOWUtYzkyOC00ZTQ4LTllZmUtMjk0Y2YwOGUzYjRiXkEyXkFqcGc@._V1_.jpg",
                "cast" => [
                    ["name" => "Rumi Hiiragi", "role" => "Chihiro"],
                    ["name" => "Miyu Irino", "role" => "Haku"]
                ],
                "rating" => 5,
                "languages" => ["Japanese", "English"],
                "duration" => 125,
            ],
            [
                "id" => 4,
                "title" => "Doraemon: Nobita’s Earth Symphony",
                "release_year" => "2023",
                "age_rating" => "All Ages",
                "genre" => ["Animasi", "Petualangan", "Keluarga"],
                "type" => "Movie",
                "image" => "https://m.media-amazon.com/images/M/MV5BNGU1ZGNkYzgtZTJhOC00ZjkyLTgzMWEtOTNiODMzODA3OTIwXkEyXkFqcGc@._V1_.jpg",
                "cast" => [
                    ["name" => "Wasabi Mizuta", "role" => "Doraemon"],
                    ["name" => "Megumi Oohara", "role" => "Nobita"]
                ],
                "rating" => 3.5,
                "languages" => ["Japanese", "Indonesian"],
                "duration" => 110,
            ],
            [
                "id" => 5,
                "title" => "How to train your dragon",
                "release_year" => "2025",
                "age_rating" => "All Ages",
                "genre" => ["Petualangan", "Keluarga"],
                "type" => "Movie",
                "image" => "https://m.media-amazon.com/images/M/MV5BODA5Y2M0NjctNWQzMy00ODRhLWE0MzUtYmE1YTAzZjYyYmQyXkEyXkFqcGc@._V1_.jpg",
                "cast" => [
                    ["name" => "Jay Baruchel", "role" => "Hiccup"],
                    ["name" => "America Ferrera", "role" => "Astrid"]
                ],
                "rating" => 4,
                "languages" => ["English"],
                "duration" => 98,
            ],
            [
                "id" => 6,
                "title" => "Jumanji, The Next Level",
                "release_year" => "2019",
                "age_rating" => "13+",
                "genre" => ["Aksi", "Petualangan", "Komedi"],
                "type" => "Movie",
                "image" => "https://m.media-amazon.com/images/M/MV5BYWFjODExZWEtYzIwYS00M2YwLTk4YTktNDQ5ZmVmOThiNmI1XkEyXkFqcGc@._V1_.jpg",
                "cast" => [
                    ["name" => "Dwayne Johnson", "role" => "Dr. Bravestone"],
                    ["name" => "Kevin Hart", "role" => "Mouse Finbar"]
                ],
                "rating" => 3,
                "languages" => ["English"],
                "duration" => 123,
            ],
            [
                "id" => 7,
                "title" => "Hunger Games: The Ballad of Songbirds and Snakes",
                "release_year" => "2023",
                "age_rating" => "13+",
                "genre" => ["Aksi", "Petualangan", "Drama"],
                "type" => "Movie",
                "image" => "https://m.media-amazon.com/images/M/MV5BZDk2YjNhYzEtYzg2ZC00OWEwLWJhYzgtMGUzMWVjNDFmYzI5XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg",
                "cast" => [
                    ["name" => "Tom Blyth", "role" => "Coriolanus Snow"],
                    ["name" => "Rachel Zegler", "role" => "Lucy Gray Baird"]
                ],
                "rating" => 4,
                "languages" => ["English"],
                "duration" => 157,
            ],
            [
                "id" => 8,
                "title" => "Oppenheimer",
                "release_year" => "2023",
                "age_rating" => "17+",
                "genre" => ["Biografi", "Drama", "Sejarah"],
                "type" => "Movie",
                "image" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQORAieVd3WE0zCe2brYIu0IP_eAbq_cksyJQ&s",
                "cast" => [
                    ["name" => "Cillian Murphy", "role" => "J. Robert Oppenheimer"],
                    ["name" => "Emily Blunt", "role" => "Kitty Oppenheimer"]
                ],
                "rating" => 4.5,
                "languages" => ["English"],
                "duration" => 180,
            ],
            [
                "id" => 9,
                "title" => "The Last of Us",
                "release_year" => "2023",
                "age_rating" => "17+",
                "genre" => ["Aksi", "Petualangan", "Drama"],
                "type" => "Serial",
                "image" => "https://image.tmdb.org/t/p/original/dmo6TYuuJgaYinXBPjrgG9mB5od.jpg",
                "cast" => [
                    ["name" => "Pedro Pascal", "role" => "Joel"],
                    ["name" => "Bella Ramsey", "role" => "Ellie"]
                ],
                "rating" => 4.5,
                "languages" => ["English"],
                "seasons" => 1
            ],
            [
                "id" => 10,
                "title" => "Wednesday",
                "release_year" => "2022",
                "age_rating" => "13+",
                "genre" => ["Drama", "Fantasi", "Misteri"],
                "type" => "Serial",
                "image" => "https://m.media-amazon.com/images/I/71M8YFEakfL.jpg",
                "cast" => [
                    ["name" => "Jenna Ortega", "role" => "Wednesday Addams"],
                    ["name" => "Catherine Zeta-Jones", "role" => "Morticia Addams"]
                ],
                "rating" => 4,
                "languages" => ["English"],
                "seasons" => 1
            ],
            [
                "id" => 11,
                "title" => "Demon Slayer: Kimetsu no Yaiba",
                "release_year" => "2019",
                "age_rating" => "17+",
                "genre" => ["Aksi", "Petualangan", "Fantasi"],
                "type" => "Serial",
                "image" => "https://image.tmdb.org/t/p/original/dZDfgqbgZ09eZ1YaXXM71y2Sskv.jpg",
                "cast" => [
                    ["name" => "Natsuki Hanae", "role" => "Tanjiro Kamado"],
                    ["name" => "Akari Kitō", "role" => "Nezuko Kamado"]
                ],
                "rating" => 5,
                "languages" => ["Japanese", "English"],
                "seasons" => 3
            ],
            [
                "id" => 12,
                "title" => "Love Next Door",
                "release_year" => "2022",
                "age_rating" => "13+",
                "genre" => ["Romantis", "Drama"],
                "type" => "Serial",
                "image" => "https://images.ctfassets.net/4cd45et68cgf/48PkoC3VSbtcNRiuBFZLZS/e5a271c2a0c008eedf34d8c794fe15f0/ENUS_LND_Teaser-Floor_Vertical_RGB_PRE.jpg",
                "cast" => [
                    ["name" => "Kim Ji-won", "role" => "Soo-min"],
                    ["name" => "Lee Min-ho", "role" => "Joon-ho"]
                ],
                "rating" => 4,
                "languages" => ["Korean"],
                "seasons" => 1
            ],
            [
                "id" => 13,
                "title" => "When Life Gives You Tangerines",
                "release_year" => "2022",
                "age_rating" => "13+",
                "genre" => ["Romantis", "Drama"],
                "type" => "Serial",
                "image" => "https://m.media-amazon.com/images/M/MV5BZTBhZTcwNWUtOTZjMi00ZjI2LWEzMzMtNWJkMWQ2ZDA0NTU3XkEyXkFqcGc@._V1_.jpg",
                "cast" => [
                    ["name" => "Han Hyo-joo", "role" => "Eun-ji"],
                    ["name" => "Park Seo-joon", "role" => "Min-ho"]
                ],
                "rating" => 4.5,
                "languages" => ["Korean"],
                "seasons" => 1
            ],
            [
                "id" => 14,
                "title" => "The Glory",
                "release_year" => "2023",
                "age_rating" => "17+",
                "genre" => ["Drama", "Thriller"],
                "type" => "Serial",
                "image" => "https://image.tmdb.org/t/p/original/uUM4LVlPgIrww07OoEKrGWlS1Ej.jpg",
                "cast" => [
                    ["name" => "Song Hye-kyo", "role" => "Moon Dong-eun"],
                    ["name" => "Lee Do-hyun", "role" => "Joo Yeo-jeong"]
                ],
                "rating" => 4.5,
                "languages" => ["Korean"],
                "seasons" => 1
            ],
            [
                "id" => 15,
                "title" => "Squid Game",
                "release_year" => "2021",
                "age_rating" => "17+",
                "genre" => ["Drama", "Thriller"],
                "type" => "Serial",
                "image" => "https://images.ctfassets.net/4cd45et68cgf/6xlqqImDdAfzWKIlaScQxm/7def051f35d6668bd6e6227e354ecc01/EN-US_SG-S2_Primary_Main_RoundandRound-Safe_Vertical_27x40_RGB_PRE.jpg?w=1200",
                "cast" => [
                    ["name" => "Lee Jung-jae", "role" => "Seong Gi-hun"],
                    ["name" => "Park Hae-soo", "role" => "Cho Sang-woo"]
                ],
                "rating" => 5,
                "languages" => ["Korean", "English"],
                "seasons" => 1
            ],
            [
                "id" => 16,
                "title" => "The Crown",
                "release_year" => "2016",
                "age_rating" => "17+",
                "genre" => ["Drama", "Sejarah"],
                "type" => "Serial",
                "image" => "https://image.tmdb.org/t/p/original/1M876KPjulVwppEpldhdc8V4o68.jpg",
                "cast" => [
                    ["name" => "Claire Foy", "role" => "Queen Elizabeth II"],
                    ["name" => "Matt Smith", "role" => "Prince Philip"]
                ],
                "rating" => 3.5,
                "languages" => ["English"],
                "seasons" => 6
            ],
            [
                "id" => 17,
                "title" => "SPY x FAMILY",
                "release_year" => "2022",
                "age_rating" => "13+",
                "genre" => ["Aksi", "Komedi", "Drama"],
                "type" => "Serial",
                "image" => "https://id-test-11.slatic.net/p/bb909f6dbb891cff68d04a7618c53281.jpg",
                "cast" => [
                    ["name" => "Takuya Eguchi", "role" => "Loid Forger"],
                    ["name" => "Atsumi Tanezaki", "role" => "Anya Forger"]
                ],
                "rating" => 4.5,
                "languages" => ["Japanese", "English"],
                "seasons" => 2
            ]
        ];
    }

    public static function getReviewsData(){
        return [
            [
                "review_id" => 1001,
                "film_id" => 1,
                "reviewer_name" => "Ayu L.",
                "rating_given" => 5.0,
                "review_text" => "Kombinasi Musik dan aksi yang sangat menghibur! Cerita unik dan visualnya memukau.",
                "date" => "2025-01-15",
                "helpful_count" => 80
            ],
            [
                "review_id" => 1002,
                "film_id" => 1,
                "reviewer_name" => "Bima S.",
                "rating_given" => 4.0,
                "review_text" => "Seru, tetapi bagian komedinya terasa kurang pas di beberapa adegan penting.",
                "date" => "2025-01-20",
                "helpful_count" => 45
            ],
            [
                "review_id" => 1003,
                "film_id" => 1,
                "reviewer_name" => "Rina H.",
                "rating_given" => 4.5,
                "review_text" => "Konsep yang berani dan *soundtrack* yang *catchy*! Sangat direkomendasikan.",
                "date" => "2025-01-22",
                "helpful_count" => 65
            ],

            // --- Film ID 2: The Exorcist: Believer (2023) ---
            [
                "review_id" => 2001,
                "film_id" => 2,
                "reviewer_name" => "Jono P.",
                "rating_given" => 3.0,
                "review_text" => "Jauh dari harapan. Ketegangan yang disajikan terasa dipaksakan dan mudah ditebak.",
                "date" => "2023-10-25",
                "helpful_count" => 120
            ],
            [
                "review_id" => 2002,
                "film_id" => 2,
                "reviewer_name" => "Siska M.",
                "rating_given" => 4.0,
                "review_text" => "Sebagai sekuel, cukup layak. Teror psikologisnya masih efektif, meski kurang orisinal.",
                "date" => "2023-11-01",
                "helpful_count" => 75
            ],

            // --- Film ID 3: Spirited Away (2001) ---
            [
                "review_id" => 3001,
                "film_id" => 3,
                "reviewer_name" => "Citra D.",
                "rating_given" => 5.0,
                "review_text" => "Sebuah mahakarya yang tak lekang oleh waktu. Visual yang indah dan makna yang mendalam.",
                "date" => "2024-11-01",
                "helpful_count" => 150
            ],
            [
                "review_id" => 3002,
                "film_id" => 3,
                "reviewer_name" => "Dani P.",
                "rating_given" => 5.0,
                "review_text" => "Nostalgia dan imajinasi murni. Film yang wajib ditonton setiap tahun.",
                "date" => "2024-11-05",
                "helpful_count" => 90
            ],

            // --- Film ID 4: Doraemon: Nobita’s Earth Symphony (2023) ---
            [
                "review_id" => 4001,
                "film_id" => 4,
                "reviewer_name" => "Eko Z.",
                "rating_given" => 3.5,
                "review_text" => "Petualangan yang manis, cocok untuk anak-anak, tapi plotnya terlalu sederhana untuk orang dewasa.",
                "date" => "2023-12-15",
                "helpful_count" => 30
            ],

            // --- Film ID 5: How to train your dragon (2025) ---
            [
                "review_id" => 5001,
                "film_id" => 5,
                "reviewer_name" => "Fani G.",
                "rating_given" => 4.0,
                "review_text" => "Versi *live-action* yang menjanjikan, semoga bisa mempertahankan keajaiban animasinya.",
                "date" => "2025-03-01",
                "helpful_count" => 55
            ],

            // --- Film ID 6: Jumanji, The Next Level (2019) ---
            [
                "review_id" => 6001,
                "film_id" => 6,
                "reviewer_name" => "Gilang W.",
                "rating_given" => 3.0,
                "review_text" => "Hanya mengulang formula yang lama. Hart dan Johnson tetap lucu, tapi ceritanya biasa saja.",
                "date" => "2019-12-20",
                "helpful_count" => 95
            ],

            // --- Film ID 7: Hunger Games: The Ballad of Songbirds and Snakes (2023) ---
            [
                "review_id" => 7001,
                "film_id" => 7,
                "reviewer_name" => "Hana A.",
                "rating_given" => 4.5,
                "review_text" => "Prequel yang sangat kuat! Pengembangan karakter Snow muda sangat menarik diikuti.",
                "date" => "2023-11-25",
                "helpful_count" => 180
            ],
            [
                "review_id" => 7002,
                "film_id" => 7,
                "reviewer_name" => "Irfan R.",
                "rating_given" => 3.5,
                "review_text" => "Film ini terasa lambat di awal, namun bagian klimaksnya sangat memuaskan.",
                "date" => "2023-12-01",
                "helpful_count" => 50
            ],

            // --- Film ID 8: Oppenheimer (2023) ---
            [
                "review_id" => 8001,
                "film_id" => 8,
                "reviewer_name" => "Karina M.",
                "rating_given" => 5.0,
                "review_text" => "Sebuah karya sinematik yang brilian dan intens. Durasi 3 jam terasa singkat.",
                "date" => "2023-07-28",
                "helpful_count" => 250
            ],
            [
                "review_id" => 8002,
                "film_id" => 8,
                "reviewer_name" => "Leo F.",
                "rating_given" => 4.5,
                "review_text" => "Pengeditan non-linier yang cerdas, dan Cillian Murphy tampil memukau.",
                "date" => "2023-08-05",
                "helpful_count" => 190
            ],

            // --- Serial ID 9: The Last of Us (2023) ---
            [
                "review_id" => 9001,
                "film_id" => 9,
                "reviewer_name" => "Mina S.",
                "rating_given" => 5.0,
                "review_text" => "Adaptasi game terbaik yang pernah ada. Emosional, mencekam, dan setia pada sumber.",
                "date" => "2023-02-10",
                "helpful_count" => 300
            ],

            // --- Serial ID 10: Wednesday (2022) ---
            [
                "review_id" => 10001,
                "film_id" => 10,
                "reviewer_name" => "Nanda Z.",
                "rating_given" => 4.0,
                "review_text" => "Jenna Ortega sempurna. Serial misteri yang ringan dan sangat populer.",
                "date" => "2022-12-01",
                "helpful_count" => 140
            ],

            // --- Serial ID 11: Demon Slayer (2019) ---
            [
                "review_id" => 11001,
                "film_id" => 11,
                "reviewer_name" => "Oscar T.",
                "rating_given" => 5.0,
                "review_text" => "Animasi terbaik di industri. Adegan aksinya adalah sebuah seni!",
                "date" => "2021-05-10",
                "helpful_count" => 210
            ],

            // --- Serial ID 15: Squid Game (2021) ---
            [
                "review_id" => 15001,
                "film_id" => 15,
                "reviewer_name" => "Queen A.",
                "rating_given" => 5.0,
                "review_text" => "Intens, menegangkan, dan sarat kritik sosial. Harus ditonton!",
                "date" => "2021-10-01",
                "helpful_count" => 280
            ],
            [
                "review_id" => 15002,
                "film_id" => 15,
                "reviewer_name" => "Rudi C.",
                "rating_given" => 4.5,
                "review_text" => "Sedikit terlalu brutal, tetapi alur ceritanya membuat ketagihan.",
                "date" => "2021-10-05",
                "helpful_count" => 110
            ],
        ];
    }
    public static function getFilmsWithReviews(){
        $all_reviews = FilmServices::getReviewsData();
        $all_films = FilmServices::getFilmsData();

        $films_with_reviews = [];

        foreach($all_films as $film){

            $film_reviews = [];

            $film_reviews = array_filter($all_reviews, function($review) use ($film) {
                return $review['film_id'] === $film['id'];
            });

            if (count($film_reviews) > 0) {
                $film['reviews'] = array_values($film_reviews);
                $films_with_reviews[] = $film;
            }
        }

        return $films_with_reviews;
    }
}
