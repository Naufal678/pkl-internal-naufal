@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        {{-- SIDEBAR FILTER --}}
        <div class="col-lg-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-danger text-white fw-bold">
                    <i class="bi bi-funnel"></i> Filter Produk
                </div>

                <div class="card-body">
                    <form action="{{ route('catalog.index') }}" method="GET">
                        @if(request('q'))
                            <input type="hidden" name="q" value="{{ request('q') }}">
                        @endif

                        {{-- Kategori --}}
                        <div class="mb-4">
                            <h6 class="fw-bold text-danger">Kategori</h6>
                            @foreach($categories as $cat)
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="radio"
                                           name="category"
                                           value="{{ $cat->slug }}"
                                           {{ request('category') == $cat->slug ? 'checked' : '' }}
                                           onchange="this.form.submit()">
                                    <label class="form-check-label">
                                        {{ $cat->name }}
                                        <span class="badge bg-warning text-dark ms-1">
                                            {{ $cat->products_count }}
                                        </span>
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        {{-- Harga --}}
                        <div class="mb-3">
                            <h6 class="fw-bold text-danger">Rentang Harga</h6>
                            <div class="d-flex gap-2">
                                <input type="number"
                                       name="min_price"
                                       class="form-control form-control-sm"
                                       placeholder="Min"
                                       value="{{ request('min_price') }}">
                                <input type="number"
                                       name="max_price"
                                       class="form-control form-control-sm"
                                       placeholder="Max"
                                       value="{{ request('max_price') }}">
                            </div>
                        </div>

                        <button class="btn btn-danger btn-sm w-100">
                            Terapkan Filter
                        </button>
                        <a href="{{ route('catalog.index') }}"
                           class="btn btn-outline-warning btn-sm w-100 mt-2">
                            Reset
                        </a>
                    </form>
                </div>
            </div>
        </div>

        {{-- PRODUCT GRID --}}
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold text-danger mb-0">
                    Katalog Produk
                </h4>

                {{-- Sorting --}}
                <form method="GET">
                    @foreach(request()->except('sort') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach

                    <select name="sort"
                            class="form-select form-select-sm border-warning"
                            onchange="this.form.submit()">
                        <option value="newest" {{ request('sort')=='newest' ? 'selected' : '' }}>
                            Terbaru
                        </option>
                        <option value="price_asc" {{ request('sort')=='price_asc' ? 'selected' : '' }}>
                            Harga Terendah
                        </option>
                        <option value="price_desc" {{ request('sort')=='price_desc' ? 'selected' : '' }}>
                            Harga Tertinggi
                        </option>
                    </select>
                </form>
            </div>

            <div class="row row-cols-1 row-cols-md-3 g-4">
                @forelse($products as $product)
                    <div class="col">
                        <x-product-card :product="$product" />
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-box-seam fs-1 text-warning"></i>
                        <h5 class="mt-3 text-danger">Produk tidak ditemukan</h5>
                        <p class="text-muted">
                            Coba kurangi filter atau gunakan kata kunci lain.
                        </p>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
