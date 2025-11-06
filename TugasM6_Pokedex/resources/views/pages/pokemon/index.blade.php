@extends("layouts.template")

@section("content")
    <div class="container-fluid p-3">
        <h3 class="page-title text-white text-shadow mt-2">Pokédex</h3>
        <div class="nav-pokedex d-flex gap-1 flex-wrap my-3">
            <a href="{{ route('pokemon.index', ['type' => 'all']) }}" class="bg-all-types text-black bg-warning">All Types</a>
            <a href="{{ route('pokemon.index', ['type' => 'normal']) }}" class="bg-normal">Normal</a>
            <a href="{{ route('pokemon.index', ['type' => 'fire']) }}" class="bg-fire">Fire</a>
            <a href="{{ route('pokemon.index', ['type' => 'water']) }}" class="bg-water">Water</a>
            <a href="{{ route('pokemon.index', ['type' => 'electric']) }}" class="bg-electric">Electric</a>
            <a href="{{ route('pokemon.index', ['type' => 'grass']) }}" class="bg-grass">Grass</a>
            <a href="{{ route('pokemon.index', ['type' => 'ice']) }}" class="bg-ice">Ice</a>
            <a href="{{ route('pokemon.index', ['type' => 'fighting']) }}" class="bg-fighting">Fighting</a>
            <a href="{{ route('pokemon.index', ['type' => 'poison']) }}" class="bg-poison">Poison</a>
            <a href="{{ route('pokemon.index', ['type' => 'ground']) }}" class="bg-ground">Ground</a>
            <a href="{{ route('pokemon.index', ['type' => 'flying']) }}" class="bg-flying">Flying</a>
            <a href="{{ route('pokemon.index', ['type' => 'psychic']) }}" class="bg-psychic">Psychic</a>
            <a href="{{ route('pokemon.index', ['type' => 'bug']) }}" class="bg-bug">Bug</a>
            <a href="{{ route('pokemon.index', ['type' => 'rock']) }}" class="bg-rock">Rock</a>
            <a href="{{ route('pokemon.index', ['type' => 'ghost']) }}" class="bg-ghost">Ghost</a>
            <a href="{{ route('pokemon.index', ['type' => 'dragon']) }}" class="bg-dragon">Dragon</a>
            <a href="{{ route('pokemon.index', ['type' => 'dark']) }}" class="bg-dark">Dark</a>
            <a href="{{ route('pokemon.index', ['type' => 'steel']) }}" class="bg-steel">Steel</a>
            <a href="{{ route('pokemon.index', ['type' => 'fairy']) }}" class="bg-fairy">Fairy</a>
        </div>
        <small class="text-white">Showing {{ count($pokemons) }} pokémon</small>
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-5 g-4 mt-1">
            @foreach ($pokemons as $pokemon)
            <a href="{{ route('pokemon.show', $pokemon['id']) }}" class="col text-decoration-none" >
                <div class="card border-4 border-navy rounded-4">
                    <div class="d-flex justify-content-center">
                        <img src="{{ $pokemon['url'] }}" class="img-fluid rounded-start py-4" alt="{{ $pokemon['name'] }}" width="125" >
                    </div>
                    <div class="card-body bg-secondary-subtle rounded-4 rounded-top-0 d-flex flex-column gap-2">
                        <h5 class="card-title">{{ $pokemon['name'] }}</h5>
                        <div class="">
                            <span class="badge bg-{{ strtolower($pokemon['primary']) }} py-2 px-3 rounded-5">{{ strtoupper($pokemon['primary']) }}</span>
                            @if ($pokemon['secondary'])
                                <span class="badge bg-{{ strtolower($pokemon['secondary']) }} py-2 px-3 rounded-5">{{ strtoupper($pokemon['secondary']) }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
@endsection
