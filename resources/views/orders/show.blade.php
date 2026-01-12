@extends('layouts.app')

@section('content')

<div class="container py-5" style="background-color:#ffffff; border-radius:16px;">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm border-0">

                {{-- Header Order --}}
                <div class="card-header text-white"
                     style="background:linear-gradient(90deg,#dc3545,#ff9800);">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h1 class="h4 mb-1 fw-bold">
                                Order #{{ $order->order_number }}
                            </h1>
                            <small>
                                {{ $order->created_at->format('d M Y, H:i') }}
                            </small>
                        </div>

                        <span class="badge rounded-pill fs-6 px-4 py-2
                            @switch($order->status)
                                @case('pending') bg-warning text-dark @break
                                @case('processing') bg-primary @break
                                @case('shipped') bg-info @break
                                @case('delivered') bg-success @break
                                @case('cancelled') bg-danger @break
                                @default bg-secondary
                            @endswitch
                        ">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>

                {{-- Produk --}}
                <div class="card-body">
                    <h3 class="h5 fw-semibold mb-4" style="color:#dc3545;">
                        Produk yang Dipesan
                    </h3>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead style="background-color:#ffe8cc;">
                                <tr>
                                    <th>Produk</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end">Harga</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->product_name }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-end">
                                        Rp {{ number_format($item->discount_price ?? $item->price, 0, ',', '.') }}
                                    </td>
                                    <td class="text-end fw-semibold" style="color:#ff9800;">
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="border-top">
                                @if($order->shipping_cost > 0)
                                <tr>
                                    <td colspan="3" class="text-end">Ongkos Kirim</td>
                                    <td class="text-end">
                                        Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td colspan="3" class="text-end fw-bold fs-5">
                                        TOTAL BAYAR
                                    </td>
                                    <td class="text-end fw-bold fs-4" style="color:#dc3545;">
                                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                {{-- Alamat --}}
                <div class="card-body border-top" style="background-color:#fff0e0;">
                    <h3 class="h6 fw-semibold mb-2" style="color:#dc3545;">
                        Alamat Pengiriman
                    </h3>
                    <address class="mb-0">
                        <strong>{{ $order->shipping_name }}</strong><br>
                        {{ $order->shipping_phone }}<br>
                        {{ $order->shipping_address }}
                    </address>
                </div>

                {{-- Bayar --}}
                @if($order->status === 'pending' && $order->snap_token)
                <div class="card-body border-top text-center">
                    <p class="text-muted mb-4">
                        Selesaikan pembayaran sebelum batas waktu berakhir.
                    </p>
                    <button id="pay-button"
                            class="btn btn-lg text-white px-5 shadow"
                            style="background-color:#dc3545;">
                        <i class="bi bi-credit-card me-2"></i> Bayar Sekarang
                    </button>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>

{{-- Snap.js --}}
@if($order->snap_token)
@push('scripts')
<script src="{{ config('midtrans.snap_url') }}"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('pay-button');
    if (!btn) return;

    btn.addEventListener('click', () => {
        btn.disabled = true;
        btn.innerHTML = '⏳ Memproses...';

        window.snap.pay('{{ $order->snap_token }}', {
            onSuccess: () => window.location.href = '{{ route("orders.success", $order) }}',
            onPending: () => window.location.href = '{{ route("orders.pending", $order) }}',
            onError: () => location.reload(),
            onClose: () => location.reload()
        });
    });
});
</script>
@endpush
@endif

@endsection
