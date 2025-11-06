<nav class="navbar bg-navy fixed-top py-3">
    <div class="container-fluid d-flex justify-content-between">
        <a class="navbar-brand text-white fw-bold">PokeDB</a>
        <div class="fw-semibold">
            <a href="{{ route('pokemon.index', ['type' => 'all']) }}" class="me-2 text-white text-decoration-none">Pokedex</a>
            <a href="{{ route('items.index', ['type' => 'all']) }}" class="me-2 text-white text-decoration-none">Items</a>
        </div>
    </div>
</nav>
