@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container py-5" style="background-color:#fff4e5; border-radius:16px;">

    <h1 class="mb-4 fw-bold" style="color:#dc3545;">
        Checkout
    </h1>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf

        <div class="row g-4">

            {{-- Form Alamat --}}
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header text-white"
                         style="background:linear-gradient(90deg,#dc3545,#ff9800);">
                        <h5 class="mb-0">Informasi Pengiriman</h5>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Penerima</label>
                            <input
                                type="text"
                                name="name"
                                value="{{ auth()->user()->name ?? '' }}"
                                class="form-control"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nomor Telepon</label>
                            <input
                                type="text"
                                name="phone"
                                class="form-control"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Alamat Lengkap</label>
                            <textarea
                                name="address"
                                rows="3"
                                class="form-control"
                                required
                            ></textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Ringkasan Pesanan --}}
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 sticky-top" style="top:1rem;">
                    <div class="card-header text-white"
                         style="background:linear-gradient(90deg,#dc3545,#ff9800);">
                        <h5 class="mb-0">Ringkasan Pesanan</h5>
                    </div>

                    <div class="card-body">
                        @if($cart && $cart->items->count())
                            <ul class="list-group list-group-flush mb-3">
                                @foreach($cart->items as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-start px-0">
                                        <div>
                                            {{ $item->product->name }}
                                            <small class="text-muted">
                                                x {{ $item->quantity }}
                                            </small>
                                        </div>
                                        <span class="fw-semibold" style="color:#ff9800;">
                                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="border-top pt-3 d-flex justify-content-between fw-bold">
                                <span>Total</span>
                                <span style="color:#dc3545;">
                                    Rp {{ number_format($cart->items->sum('subtotal'), 0, ',', '.') }}
                                </span>
                            </div>

                            <button
                                type="submit"
                                class="btn w-100 mt-4 text-white"
                                style="background-color:#dc3545;"
                            >
                                Buat Pesanan
                            </button>
                        @else
                            <p class="text-muted mb-0">
                                Keranjang masih kosong.
                            </p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection
