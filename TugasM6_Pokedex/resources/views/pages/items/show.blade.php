@extends("layouts.template")

@section("content")
<div class="d-flex justify-content-center align-items-center" style="height: 85vh">
    <div class="container">
        <div class="row">
            <div class="col-md-4 bg-light border border-4 border-end-0 border-navy rounded-start-5 d-flex flex-column justify-content-between align-items-center p-4">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <a class="btn bg-navy btn-primary border-navy" href="{{ route('items.index', ['type' => 'All']) }}"><i class="bi bi-arrow-left"></i> Back to Items</a>
                    <span class="bg-navy rounded-pill fw-bold text-white p-2 px-3">#{{ sprintf("%03d", $item['id']) }}</span>
                </div>
                <img src="{{ $item['icon'] }}" class="img-fluid rounded-start" alt="{{ $item['name'] }}" width="150">
                <div class="">
                    <h1 class="card-title mb-3">{{ $item['name'] }}</h1>
                    <div class="d-flex justify-content-center gap-3 mb-4">
                        <span class="badge bg-{{ strtolower(str_replace(' ', '-', $item['category'])) }} py-2 px-3 rounded-5">{{ strtoupper($item['category']) }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-8 bg-navy rounded-end-5 text-white p-4 d-flex flex-column">
                <h3 class="fw-bold mt-3 mb-4">Item Details</h3>
                <span class="fs-5 fw-bold mb-3">Effect</span>
                <span class="bg-regular rounded-2 text-start p-3">{{ $item['effect'] }}</span>
                <span class="fs-5 fw-bold mb-3 mt-4">Description</span>
                <small class="bg-white text-dark rounded-2 text-start p-3">{{ $item['description'] }}</small>
                <span class="fs-5 fw-bold mb-3 mt-4">Price</span>
                <div class="row row-cols-2 g-3">
                    <div class="col">
                        <div class="bg-price py-2 px-3 rounded-3 h-100">
                            <small class="text-muted fw-semibold" style="font-size: 11px;">BUY PRICE</small>
                            <h5 class="text-price">₽{{ number_format($item['price']) }}</h5>
                        </div>
                    </div>
                    <div class="col">
                        <div class="bg-sell py-2 px-3 rounded-3 h-100">
                            <small class="text-muted fw-semibold" style="font-size: 11px;">SELL PRICE</small>
                            <h5 class="text-sell">₽{{ number_format($item['price']/2) }}</h5>
                        </div>
                    </div>
                    <div class="col">
                        <div class="bg-sell py-2 px-3 rounded-3 h-100">
                            <small class="text-muted fw-semibold" style="font-size: 11px;">ITEM TYPE</small>
                            <h6 class="text-dark fw-bold mt-1">{{ $item['category'] }}</h6>
                        </div>
                    </div>
                    <div class="col">
                        <div class="bg-sell py-2 px-3 rounded-3 h-100">
                            <small class="text-muted fw-semibold" style="font-size: 11px;">AVAILABILITY</small>
                            <h6 class="text-success fw-bold mt-1">Available in Poké Marts</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
