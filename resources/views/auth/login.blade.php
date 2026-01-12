@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card border-0 shadow-lg rounded-4">
                {{-- HEADER --}}
                <div class="card-header text-white text-center rounded-top-4"
                     style="background: linear-gradient(90deg, #EF4444, #F97316);">
                    <h4 class="mb-0 fw-bold">🍟 Login ke SnackFavorit</h4>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

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
                                autofocus
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

                        {{-- REMEMBER --}}
                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">
                                Ingat Saya
                            </label>
                        </div>

                        {{-- BUTTON LOGIN --}}
                        <div class="d-grid">
                            <button type="submit"
                                class="btn btn-lg text-white"
                                style="background:#F97316;">
                                🔐 Login
                            </button>
                        </div>

                        {{-- LUPA PASSWORD --}}
                        <div class="mt-3 text-center">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                   class="text-decoration-none text-danger fw-semibold">
                                    Lupa Password?
                                </a>
                            @endif
                        </div>

                        <hr>

                        {{-- GOOGLE LOGIN --}}
                        <div class="d-grid">
                            <a href="{{ route('auth.google') }}"
                               class="btn btn-outline-danger btn-lg">
                                <img src="https://www.svgrepo.com/show/475656/google-color.svg"
                                     width="20"
                                     class="me-2">
                                Login dengan Google
                            </a>
                        </div>

                        {{-- REGISTER --}}
                        <p class="mt-4 text-center mb-0">
                            Belum punya akun?
                            <a href="{{ route('register') }}"
                               class="fw-bold text-danger text-decoration-none">
                                Daftar Sekarang
                            </a>
                        </p>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
