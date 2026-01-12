@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card border-0 shadow-lg rounded-4">
                {{-- HEADER --}}
                <div class="card-header text-white text-center rounded-top-4"
                     style="background: linear-gradient(90deg, #EF4444, #F97316);">
                    <h4 class="mb-0 fw-bold">🍩 Daftar Akun SnackFavorit</h4>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- NAME --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                class="form-control form-control-lg @error('name') is-invalid @enderror"
                                placeholder="Nama lengkap"
                                required
                                autofocus
                            >
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- EMAIL --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="form-control form-control-lg @error('email') is-invalid @enderror"
                                placeholder="nama@email.com"
                                required
                            >
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- PASSWORD --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <input
                                type="password"
                                name="password"
                                class="form-control form-control-lg @error('password') is-invalid @enderror"
                                placeholder="••••••••"
                                required
                            >
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- CONFIRM PASSWORD --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Konfirmasi Password</label>
                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control form-control-lg"
                                placeholder="••••••••"
                                required
                            >
                        </div>

                        {{-- BUTTON REGISTER --}}
                        <div class="d-grid">
                            <button type="submit"
                                    class="btn btn-lg text-white"
                                    style="background:#F97316;">
                                📝 Daftar Sekarang
                            </button>
                        </div>

                        {{-- LINK LOGIN --}}
                        <p class="mt-4 text-center mb-0">
                            Sudah punya akun?
                            <a href="{{ route('login') }}"
                               class="fw-bold text-danger text-decoration-none">
                                Login di sini
                            </a>
                        </p>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
