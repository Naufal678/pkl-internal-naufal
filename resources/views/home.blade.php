{{-- ================================================
 FILE: resources/views/home.blade.php
 FUNGSI: Halaman utama website (Enhanced UI)
 ================================================ --}}

@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

{{-- ================= HERO ================= --}}
<section class="py-5 text-white"
    style="background: linear-gradient(135deg, #dc3545, #ff9800);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <span class="badge bg-warning text-dark mb-3">
                    🔥 Promo Spesial
                </span>
                <h1 class="display-4 fw-bold mb-3">
                    Snack Favorit,<br>Tinggal Klik 🍟
                </h1>
                <p class="lead mb-4">
                    Snack pedas, manis, gurih — semua ada!
                    Gratis ongkir pembelian pertama 🎉
                </p>
                <a href="{{ route('catalog.index') }}"
                   class="btn btn-warning btn-lg shadow">
                    <i class="bi bi-cart-check me-2"></i>Belanja Sekarang
                </a>
            </div>
            <div class="col-lg-6 d-none d-lg-block text-center">
                <img src="{{ asset('../storage/products/logo-removebg-preview.png') }}"
                     class="img-fluid" style="max-height:380px;">
            </div>
        </div>
    </div>
</section>

{{-- ================= KATEGORI ================= --}}
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold mb-4">
            🍩 Kategori Favorit
        </h2>
        <div class="row g-4">
            @foreach($categories as $category)
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('catalog.index', ['category' => $category->slug]) }}"
                       class="text-decoration-none text-dark">
                        <div class="card border-0 shadow-sm text-center h-100">
                            <div class="card-body">
                                <img src="{{ $category->image_url }}"
                                     class="rounded-circle mb-3"
                                     width="80" height="80"
                                     style="object-fit:cover;">
                                <h6 class="fw-bold mb-0">{{ $category->name }}</h6>
                                <small class="text-muted">
                                    {{ $category->products_count }} produk
                                </small>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= PRODUK UNGGULAN ================= --}}
<section class="py-5" style="background-color:#fff3cd;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-danger">
                ⭐ Produk Unggulan
            </h2>
            <a href="{{ route('catalog.index') }}"
               class="btn btn-outline-danger">
                Lihat Semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        <div class="row g-4">
            @foreach($featuredProducts as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    @include('partials.product-card', ['product' => $product])
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= PROMO ================= --}}
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card text-white border-0 shadow"
                     style="background: linear-gradient(135deg, #ff5722, #dc3545);">
                    <div class="card-body">
                        <h3>🔥 Flash Sale</h3>
                        <p>Diskon hingga <strong>50%</strong> hari ini</p>
                        <a href="#" class="btn btn-light">
                            Lihat Promo
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-dark text-white border-0 shadow">
                    <div class="card-body">
                        <h3>🎁 Member Baru?</h3>
                        <p>Dapatkan voucher <strong>Rp 50.000</strong></p>
                        <a href="{{ route('register') }}"
                           class="btn btn-warning">
                            Daftar Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ================= PRODUK TERBARU ================= --}}
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold mb-4">
            🆕 Produk Terbaru
        </h2>
        <div class="row g-4">
            @foreach($latestProducts as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    @include('partials.product-card', ['product' => $product])
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
