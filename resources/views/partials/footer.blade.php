{{-- ================================================
 FILE: resources/views/partials/footer.blade.php
 FUNGSI: Footer website (Tema Merah + Kuning)
 ================================================ --}}

<footer class="pt-5 pb-3 mt-5 text-white"
    style="background: linear-gradient(135deg, #dc3545, #ff9800);">
    <div class="container">

        <div class="row g-4">
            {{-- Brand --}}
            <div class="col-lg-4 col-md-6">
                <h5 class="fw-bold mb-3">
                    <i class="bi bi-bag-heart-fill me-2"></i>Snack Online
                </h5>
                <p class="text-light opacity-75">
                    Snack online terpercaya dengan berbagai produk lezat.
                    Belanja mudah, aman, dan cepat 🍟
                </p>
                <div class="d-flex gap-3 mt-3">
                    <a href="#" class="text-white fs-5"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white fs-5"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white fs-5"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="text-white fs-5"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            {{-- Menu --}}
            <div class="col-lg-2 col-md-6">
                <h6 class="fw-bold mb-3">Menu</h6>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('catalog.index') }}"
                           class="text-white text-decoration-none opacity-75">
                            Katalog Produk
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-white text-decoration-none opacity-75">
                            Tentang Kami
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-white text-decoration-none opacity-75">
                            Kontak
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Bantuan --}}
            <div class="col-lg-2 col-md-6">
                <h6 class="fw-bold mb-3">Bantuan</h6>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="#" class="text-white text-decoration-none opacity-75">
                            FAQ
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-white text-decoration-none opacity-75">
                            Cara Belanja
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-white text-decoration-none opacity-75">
                            Kebijakan Privasi
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Kontak --}}
            <div class="col-lg-4 col-md-6">
                <h6 class="fw-bold mb-3">Hubungi Kami</h6>
                <ul class="list-unstyled opacity-75">
                    <li class="mb-2">
                        <i class="bi bi-geo-alt me-2"></i>
                        Bandung, Indonesia
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-telephone me-2"></i>
                        08xx-xxxx-xxxx
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-envelope me-2"></i>
                        info@snackonline.com
                    </li>
                </ul>
            </div>
        </div>

        <hr class="my-4 border-light opacity-50">

        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-0 small opacity-75">
                    &copy; {{ date('Y') }} Snack Online. All rights reserved.
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                <span class="badge bg-warning text-dark px-3 py-2">
                    💳 Pembayaran Aman & Terpercaya
                </span>
            </div>
        </div>

    </div>
</footer>
