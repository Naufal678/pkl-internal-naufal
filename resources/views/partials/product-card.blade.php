<div class="card product-card h-100 border-0">
    {{-- Image --}}
    <div class="position-relative overflow-hidden">
        <a href="{{ route('catalog.show', $product->slug) }}">
            <img src="{{ $product->image_url }}"
                 class="card-img-top"
                 alt="{{ $product->name }}"
                 style="height: 220px; object-fit: cover;">
        </a>

        {{-- Discount --}}
        @if($product->has_discount)
            <span class="badge-discount">
                -{{ $product->discount_percentage }}%
            </span>
        @endif

        {{-- Wishlist --}}
        @auth
            <div class="wishlist-btn">
                <button onclick="toggleWishlist({{ $product->id }})"
                        class="btn btn-light btn-sm rounded-circle">
                    <i class="bi {{ Auth::user()->hasInWishlist($product) ? 'bi-heart-fill text-danger' : 'bi-heart text-secondary' }}"></i>
                </button>
            </div>
        @endauth
    </div>

    {{-- Body --}}
    <div class="card-body d-flex flex-column">
        {{-- Category --}}
        <span class="product-category mb-2">
            {{ $product->category->name }}
        </span>

        {{-- Name --}}
        <h6 class="mb-2">
            <a href="{{ route('catalog.show', $product->slug) }}"
               class="text-dark text-decoration-none stretched-link">
                {{ Str::limit($product->name, 45) }}
            </a>
        </h6>

        {{-- Price --}}
        <div class="mt-auto">
            @if($product->has_discount)
                <div class="price-original text-muted text-decoration-line-through">
                    {{ $product->formatted_original_price }}
                </div>
            @endif

            <div class="price-final text-primary">
                {{ $product->formatted_price }}
            </div>
        </div>

        {{-- Stock --}}
        @if($product->stock <= 5 && $product->stock > 0)
            <small class="text-warning mt-2">
                <i class="bi bi-exclamation-circle"></i>
                Sisa {{ $product->stock }} item
            </small>
        @elseif($product->stock == 0)
            <small class="text-danger mt-2">
                <i class="bi bi-x-circle"></i> Stok Habis
            </small>
        @endif
    </div>

    {{-- Footer --}}
    <div class="card-footer bg-white border-0">
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" value="1">

            <button type="submit"
                    class="btn btn-primary w-100 rounded-pill"
                    @if($product->stock == 0) disabled @endif>
                <i class="bi bi-cart-plus me-1"></i>
                {{ $product->stock == 0 ? 'Stok Habis' : 'Tambah ke Keranjang' }}
            </button>
        </form>
    </div>
</div>
