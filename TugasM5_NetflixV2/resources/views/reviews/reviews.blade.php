<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
     <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body class="pt-5" style="min-height: 100vh; background: #141414;">
    <nav class="navbar bg-black fixed-top">
        <div class="container w-75">
            <a class="navbar-brand" href="#">
            <img src="{{ url('asset_tugas/logo.png') }}" alt="Netflix" width="90" height="50">
            </a>
            <div>
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off">
                    <a href="{{ url('/films') }}" class="btn btn-outline-light" for="btnradio1">All</a>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                    <a href="{{ url('/films/serial') }}" class="btn btn-outline-light" for="btnradio2">Series</a>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                    <a href="{{ url('/films/movies') }}" class="btn btn-outline-light" for="btnradio3">Movies</a>
                </div>
                <a href="{{ url('/reviews') }}" class="btn btn-danger fw-bold ms-2">Reviews</a>
            </div>
        </div>
    </nav>
    <div class="container-fluid p-4 border-bottom border-secondary" style="background: #282828;">
        <div class="text-center text-white mt-4 ">
            <div><i class="bi bi-funnel-fill"></i> Filter Reviews:
                <a href=" {{ url('/reviews') }}" class="btn btn-sm {{ $selected_filter === 'all' ? 'btn-danger' : 'btn-outline-light' }}"><i class="bi bi-grid-3x3-gap"></i> All Reviews</a>
                <a href=" {{ url('/reviews/top-reviewed') }}" class="btn btn-sm {{ $selected_filter === 'top' ? 'btn-danger' : 'btn-outline-light' }}"><i class="bi bi-hand-thumbs-up-fill"></i> Top Reviewed</a>
                <a href=" {{ url('/reviews/5-stars') }}" class="btn btn-sm {{ $selected_filter === 'five_stars' ? 'btn-danger' : 'btn-outline-light' }}"><i class="bi bi-star-fill"></i> 5 Stars (5)</a>
                <a href=" {{ url('/reviews/4-stars') }}" class="btn btn-sm {{ $selected_filter === 'four_stars' ? 'btn-danger' : 'btn-outline-light' }}"><i class="bi bi-star-fill"></i> 4 Stars (3-4)</a>
                <a href=" {{ url('/reviews/3-stars') }}" class="btn btn-sm {{ $selected_filter === 'three_stars' ? 'btn-danger' : 'btn-outline-light' }}"><i class="bi bi-star-fill"></i> 3 Stars (< 3)</a>
            </div>
            <div class="mt-3">
                <span class="badge bg-dark p-2"><i class="bi bi-chat-square-quote me-1"></i> Showing {{ $total_reviews }} reviews</span>
            </div>
        </div>
    </div>
    <div class="container w-75">
        @if ($selected_filter === 'all')
            @if (count($films) === 0)
                <div class="text-center text-white mt-5">
                    <h3>No reviews available.</h3>
                </div>
            @else
                @foreach ($films as $f)
                    <div class="row mt-5 align-items-center">
                        <div class="col-1">
                            <img src="{{ $f['image'] }}" alt="img" class="rounded-3" width="120" height="180">
                        </div>
                        <div class="col-10 offset-1 text-white">
                            <div class="d-flex align-items-center gap-2">
                                <h3 class="text-danger fw-bold">{{ $f['title'] }}</h3>
                                @if ($f['type'] === 'Movie')
                                    <span class="badge bg-info text-dark"> Movie</span>

                                @else
                                    <span class="badge bg-warning text-dark">Series</span>
                                @endif

                                @if ($f['age_rating'] === '13+')
                                    <span class="badge bg-warning text-dark">13+</span>

                                @elseif($f['age_rating'] === '17+')
                                    <span class="badge bg-danger text-white">18+</span>
                                @else
                                    <span class="badge bg-success text-white">All Ages</span>
                                @endif
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <small><i class="bi bi-calendar3"></i> {{ $f['release_year'] }}</small>
                                <small><i class="bi bi-star-fill text-warning"></i> {{ $f['rating'] }}/5</small>
                                <small><i class="bi bi-chat-square-quote me-1"></i> {{ count($f['reviews']) }} Reviews</small>
                            </div>
                            <div class="d-flex align-items-center gap-2 mt-2">
                                @foreach ($f['genre'] as $genre)
                                    <span class="badge bg-secondary">{{ $genre }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($f['reviews'] as $review)
                            <div class="col-6">
                                <div class="container p-3 rounded-2 mt-3 text-white" style="min-height: 182px; background: #282828;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center gap-1">
                                            <i class="bi bi-person-circle text-danger"></i>
                                            <b class="text-white fw-bold">{{ $review['reviewer_name'] }}</b>
                                        </div>
                                        <div class="text-warning">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $review['rating_given'])
                                                    <i class="bi bi-star-fill"></i>
                                                    @continue
                                                @elseif ($i - 1 < $review['rating_given'] && $review['rating_given'] < $i)
                                                    <i class="bi bi-star-half"></i>
                                                    @continue
                                                @endif
                                                <i class="bi bi-star"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-1">
                                        <small style="color: #666666;"><i class="bi bi-calendar-event me-1"></i> {{ formatDate($review['date']) }}</small>
                                        <span class="badge bg-danger">{{ $review['rating_given'] }}/5 </span>
                                    </div>
                                    <p class="mt-3"><i class="bi bi-quote text-danger"></i> {{ $review['review_text'] }}</p>
                                    <div class="d-flex justify-content-end">
                                        <span class="badge bg-dark"><i class="bi bi-hand-thumbs-up me-1"></i> {{ $review['helpful_count'] }} Found this helpful</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @endif
        @elseif ($selected_filter === 'top')
            <div class="row mt-5 align-items-center">
                <div class="col-1">
                    <img src="{{ $top_film['image'] }}" alt="img" class="rounded-3" width="120" height="180">
                </div>
                <div class="col-10 offset-1 text-white">
                    <div class="d-flex align-items-center gap-2">
                        <h3 class="text-danger fw-bold">{{ $top_film['title'] }}</h3>
                        @if ($top_film['type'] === 'Movie')
                            <span class="badge bg-info text-dark"> Movie</span>

                        @else
                            <span class="badge bg-warning text-dark">Series</span>
                        @endif

                        @if ($top_film['age_rating'] === '13+')
                            <span class="badge bg-warning text-dark">13+</span>

                        @elseif($top_film['age_rating'] === '17+')
                            <span class="badge bg-danger text-white">18+</span>
                        @else
                            <span class="badge bg-success text-white">All Ages</span>
                        @endif
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <small><i class="bi bi-calendar3"></i> {{ $top_film['release_year'] }}</small>
                        <small><i class="bi bi-star-fill text-warning"></i> {{ $top_film['rating'] }}/5</small>
                        <small><i class="bi bi-chat-square-quote me-1"></i> {{ count($top_film['reviews']) }} Reviews</small>
                    </div>
                    <div class="d-flex align-items-center gap-2 mt-2">
                        @foreach ($top_film['genre'] as $genre)
                            <span class="badge bg-secondary">{{ $genre }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($top_film['reviews'] as $review)
                    <div class="col-6">
                        <div class="container p-3 rounded-2 mt-3 text-white" style="min-height: 182px; background: #282828;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center gap-1">
                                    <i class="bi bi-person-circle text-danger"></i>
                                    <b class="text-white fw-bold">{{ $review['reviewer_name'] }}</b>
                                </div>
                                <div class="text-warning">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $review['rating_given'])
                                            <i class="bi bi-star-fill"></i>
                                            @continue
                                        @elseif ($i - 1 < $review['rating_given'] && $review['rating_given'] < $i)
                                            <i class="bi bi-star-half"></i>
                                            @continue
                                        @endif
                                        <i class="bi bi-star"></i>
                                    @endfor
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-1">
                                <small style="color: #666666;"><i class="bi bi-calendar-event me-1"></i> {{ formatDate($review['date']) }}</small>
                                <span class="badge bg-danger">{{ $review['rating_given'] }}/5 </span>
                            </div>
                            <p class="mt-3"><i class="bi bi-quote text-danger"></i> {{ $review['review_text'] }}</p>
                            <div class="d-flex justify-content-end">
                                <span class="badge bg-dark"><i class="bi bi-hand-thumbs-up me-1"></i> {{ $review['helpful_count'] }} Found this helpful</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif ($selected_filter === 'five_stars')
            @if (count($films) === 0)
                <div class="text-center text-white mt-5">
                    <h5>No films found above 4 stars.</h5>
                </div>
            @else
                @foreach ($films as $f)
                    <div class="row mt-5 align-items-center">
                        <div class="col-1">
                            <img src="{{ $f['image'] }}" alt="img" class="rounded-3" width="120" height="180">
                        </div>
                        <div class="col-10 offset-1 text-white">
                            <div class="d-flex align-items-center gap-2">
                                <h3 class="text-danger fw-bold">{{ $f['title'] }}</h3>
                                @if ($f['type'] === 'Movie')
                                    <span class="badge bg-info text-dark"> Movie</span>

                                @else
                                    <span class="badge bg-warning text-dark">Series</span>
                                @endif

                                @if ($f['age_rating'] === '13+')
                                    <span class="badge bg-warning text-dark">13+</span>

                                @elseif($f['age_rating'] === '17+')
                                    <span class="badge bg-danger text-white">18+</span>
                                @else
                                    <span class="badge bg-success text-white">All Ages</span>
                                @endif
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <small><i class="bi bi-calendar3"></i> {{ $f['release_year'] }}</small>
                                <small><i class="bi bi-star-fill text-warning"></i> {{ $f['rating'] }}/5</small>
                                <small><i class="bi bi-chat-square-quote me-1"></i> {{ count($f['reviews']) }} Reviews</small>
                            </div>
                            <div class="d-flex align-items-center gap-2 mt-2">
                                @foreach ($f['genre'] as $genre)
                                    <span class="badge bg-secondary">{{ $genre }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($f['reviews'] as $review)
                            <div class="col-6">
                                <div class="container p-3 rounded-2 mt-3 text-white" style="min-height: 182px; background: #282828;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center gap-1">
                                            <i class="bi bi-person-circle text-danger"></i>
                                            <b class="text-white fw-bold">{{ $review['reviewer_name'] }}</b>
                                        </div>
                                        <div class="text-warning">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $review['rating_given'])
                                                    <i class="bi bi-star-fill"></i>
                                                    @continue
                                                @elseif ($i - 1 < $review['rating_given'] && $review['rating_given'] < $i)
                                                    <i class="bi bi-star-half"></i>
                                                    @continue
                                                @endif
                                                <i class="bi bi-star"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-1">
                                        <small style="color: #666666;"><i class="bi bi-calendar-event me-1"></i> {{ formatDate($review['date']) }}</small>
                                        <span class="badge bg-danger">{{ $review['rating_given'] }}/5 </span>
                                    </div>
                                    <p class="mt-3"><i class="bi bi-quote text-danger"></i> {{ $review['review_text'] }}</p>
                                    <div class="d-flex justify-content-end">
                                        <span class="badge bg-dark"><i class="bi bi-hand-thumbs-up me-1"></i> {{ $review['helpful_count'] }} Found this helpful</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @endif
        @elseif ($selected_filter === 'four_stars')
            @if (count($films) === 0)
                <div class="text-center text-white mt-5">
                    <h5>No films found between 3 and 4 stars.</h3>
                </div>
            @else
                @foreach ($films as $f)
                    <div class="row mt-5 align-items-center">
                        <div class="col-1">
                            <img src="{{ $f['image'] }}" alt="img" class="rounded-3" width="120" height="180">
                        </div>
                        <div class="col-10 offset-1 text-white">
                            <div class="d-flex align-items-center gap-2">
                                <h3 class="text-danger fw-bold">{{ $f['title'] }}</h3>
                                @if ($f['type'] === 'Movie')
                                    <span class="badge bg-info text-dark"> Movie</span>

                                @else
                                    <span class="badge bg-warning text-dark">Series</span>
                                @endif

                                @if ($f['age_rating'] === '13+')
                                    <span class="badge bg-warning text-dark">13+</span>

                                @elseif($f['age_rating'] === '17+')
                                    <span class="badge bg-danger text-white">18+</span>
                                @else
                                    <span class="badge bg-success text-white">All Ages</span>
                                @endif
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <small><i class="bi bi-calendar3"></i> {{ $f['release_year'] }}</small>
                                <small><i class="bi bi-star-fill text-warning"></i> {{ $f['rating'] }}/5</small>
                                <small><i class="bi bi-chat-square-quote me-1"></i> {{ count($f['reviews']) }} Reviews</small>
                            </div>
                            <div class="d-flex align-items-center gap-2 mt-2">
                                @foreach ($f['genre'] as $genre)
                                    <span class="badge bg-secondary">{{ $genre }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($f['reviews'] as $review)
                            <div class="col-6">
                                <div class="container p-3 rounded-2 mt-3 text-white" style="min-height: 182px; background: #282828;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center gap-1">
                                            <i class="bi bi-person-circle text-danger"></i>
                                            <b class="text-white fw-bold">{{ $review['reviewer_name'] }}</b>
                                        </div>
                                        <div class="text-warning">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $review['rating_given'])
                                                    <i class="bi bi-star-fill"></i>
                                                    @continue
                                                @elseif ($i - 1 < $review['rating_given'] && $review['rating_given'] < $i)
                                                    <i class="bi bi-star-half"></i>
                                                    @continue
                                                @endif
                                                <i class="bi bi-star"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-1">
                                        <small style="color: #666666;"><i class="bi bi-calendar-event me-1"></i> {{ formatDate($review['date']) }}</small>
                                        <span class="badge bg-danger">{{ $review['rating_given'] }}/5 </span>
                                    </div>
                                    <p class="mt-3"><i class="bi bi-quote text-danger"></i> {{ $review['review_text'] }}</p>
                                    <div class="d-flex justify-content-end">
                                        <span class="badge bg-dark"><i class="bi bi-hand-thumbs-up me-1"></i> {{ $review['helpful_count'] }} Found this helpful</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @endif
        @elseif ($selected_filter === 'three_stars')
            @if (count($films) === 0)
                <div class="text-center text-white mt-5">
                    <h5>No films found with less than 3 stars.</h5>
                </div>
            @else
                @foreach ($films as $f)
                    <div class="row mt-5 align-items-center">
                        <div class="col-1">
                            <img src="{{ $f['image'] }}" alt="img" class="rounded-3" width="120" height="180">
                        </div>
                        <div class="col-10 offset-1 text-white">
                            <div class="d-flex align-items-center gap-2">
                                <h3 class="text-danger fw-bold">{{ $f['title'] }}</h3>
                                @if ($f['type'] === 'Movie')
                                    <span class="badge bg-info text-dark"> Movie</span>

                                @else
                                    <span class="badge bg-warning text-dark">Series</span>
                                @endif

                                @if ($f['age_rating'] === '13+')
                                    <span class="badge bg-warning text-dark">13+</span>

                                @elseif($f['age_rating'] === '17+')
                                    <span class="badge bg-danger text-white">18+</span>
                                @else
                                    <span class="badge bg-success text-white">All Ages</span>
                                @endif
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <small><i class="bi bi-calendar3"></i> {{ $f['release_year'] }}</small>
                                <small><i class="bi bi-star-fill text-warning"></i> {{ $f['rating'] }}/5</small>
                                <small><i class="bi bi-chat-square-quote me-1"></i> {{ count($f['reviews']) }} Reviews</small>
                            </div>
                            <div class="d-flex align-items-center gap-2 mt-2">
                                @foreach ($f['genre'] as $genre)
                                    <span class="badge bg-secondary">{{ $genre }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($f['reviews'] as $review)
                            <div class="col-6">
                                <div class="container p-3 rounded-2 mt-3 text-white" style="min-height: 182px; background: #282828;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center gap-1">
                                            <i class="bi bi-person-circle text-danger"></i>
                                            <b class="text-white fw-bold">{{ $review['reviewer_name'] }}</b>
                                        </div>
                                        <div class="text-warning">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $review['rating_given'])
                                                    <i class="bi bi-star-fill"></i>
                                                    @continue
                                                @elseif ($i - 1 < $review['rating_given'] && $review['rating_given'] < $i)
                                                    <i class="bi bi-star-half"></i>
                                                    @continue
                                                @endif
                                                <i class="bi bi-star"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-1">
                                        <small style="color: #666666;"><i class="bi bi-calendar-event me-1"></i> {{ formatDate($review['date']) }}</small>
                                        <span class="badge bg-danger">{{ $review['rating_given'] }}/5 </span>
                                    </div>
                                    <p class="mt-3"><i class="bi bi-quote text-danger"></i> {{ $review['review_text'] }}</p>
                                    <div class="d-flex justify-content-end">
                                        <span class="badge bg-dark"><i class="bi bi-hand-thumbs-up me-1"></i> {{ $review['helpful_count'] }} Found this helpful</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @endif
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <?php
        function renderStars($rating) {
            $stars = '';
            for ($i = 1; $i <= 5; $i++) {
                if ($i <= $rating) {
                    $stars .= '<i class="bi bi-star-fill"></i>';
                } elseif ($i - 1 < $rating && $rating < $i) {
                    $stars .= '<i class="bi bi-star-half"></i>';
                } else {
                    $stars .= '<i class="bi bi-star"></i>';
                }
            }
            return $stars;
        }
        function formatDate($dateString) {
            // $date = new DateTime($dateString);
            // return $date->format('F j, Y');

            $months = [
                1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
                5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
                9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
            ];
            $dateParts = explode('-', $dateString);
            $year = $dateParts[0];
            $month = (int)$dateParts[1];
            $day = ltrim($dateParts[2], '0');
            return $months[$month] . ' ' . $day . ', ' . $year;
        }
    ?>
</body>
</html>
