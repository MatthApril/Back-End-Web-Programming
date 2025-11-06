@extends("layouts.template")

@section("content")
    <div class="container-fluid p-3">
        <h3 class="page-title text-white text-shadow mt-2">Pokémon Items</h3>
        <div class="nav-pokedex d-flex gap-1 flex-wrap my-3">
            <a href="{{ route('items.index', ['type' => 'All']) }}" class="bg-all-types text-black bg-warning">All Types</a>
            <a href="{{ route('items.index', ['type' => 'Medicine']) }}" class="bg-medicine">Medicine</a>
            <a href="{{ route('items.index', ['type' => 'Poké Balls']) }}" class="bg-poké-balls">Poké Balls</a>
            <a href="{{ route('items.index', ['type' => 'Berries']) }}" class="bg-berries">Berries</a>
            <a href="{{ route('items.index', ['type' => 'Vitamins']) }}" class="bg-vitamins">Vitamins</a>
            <a href="{{ route('items.index', ['type' => 'Battle Items']) }}" class="bg-battle-items">Battle Items</a>
            <a href="{{ route('items.index', ['type' => 'Other Items']) }}" class="bg-other-items">Other</a>
        </div>
        <small class="text-white">Showing {{ count($items) }} items</small>
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-5 g-4 mt-1">
            @foreach ($items as $item)
            <a href="{{ route('items.show', $item['id']) }}" class="col text-decoration-none" >
                <div class="card border-4 border-navy rounded-4">
                    <div class="d-flex justify-content-center">
                        <img src="{{ $item['icon'] }}" class="img-fluid rounded-start py-4" alt="{{ $item['name'] }}" width="125" >
                    </div>
                    <div class="card-body bg-secondary-subtle rounded-4 rounded-top-0 d-flex flex-column gap-2">
                        <h5 class="card-title">{{ $item['name'] }}</h5>
                        <div class="">
                            <span class="badge bg-{{ strtolower(str_replace(' ', '-', $item['category'])) }} py-2 px-3 rounded-5">{{ strtoupper($item['category']) }}</span>
                        </div>
                        <small class="fw-semibold text-muted">{{ $item['effect'] }}</small>
                        <div class="d-flex justify-content-between">
                            <small class="fw-semibold text-muted">Price:</small>
                            <span class="text-price">₽{{ number_format($item['price']) }}</span>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
@endsection
