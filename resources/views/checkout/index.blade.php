{{-- resources/views/checkout/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container py-5">

    <h1 class="mb-4 fw-bold">Checkout</h1>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf

        <div class="row g-4">

            {{-- Form Alamat --}}
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Informasi Pengiriman</h5>

                        <div class="mb-3">
                            <label class="form-label">Nama Penerima</label>
                            <input
                                type="text"
                                name="name"
                                value="{{ auth()->user()->name ?? '' }}"
                                class="form-control"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nomor Telepon</label>
                            <input
                                type="text"
                                name="phone"
                                class="form-control"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat Lengkap</label>
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

            {{-- Order Summary --}}
            <div class="col-lg-4">
                <div class="card shadow-sm sticky-top" style="top: 1rem;">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Ringkasan Pesanan</h5>

                        @if($cart && $cart->items->count())
                            <ul class="list-group list-group-flush mb-3">
                                @foreach($cart->items as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-start px-0">
                                        <div>
                                            {{ $item->product->name }}
                                            <small class="text-muted">x {{ $item->quantity }}</small>
                                        </div>
                                        <span class="fw-semibold">
                                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="border-top pt-3 d-flex justify-content-between fw-bold">
                                <span>Total</span>
                                <span>
                                    Rp {{ number_format($cart->items->sum('subtotal'), 0, ',', '.') }}
                                </span>
                            </div>

                            <button
                                type="submit"
                                class="btn btn-primary w-100 mt-4"
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
