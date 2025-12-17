<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('tentang', function () {
    return view('tentang');
});

// ================================================
// ROUTE DENGAN PARAMETER DINAMIS
// ================================================
// {nama} adalah parameter yang akan diisi dari URL
// ================================================

Route::get('/sapa/{nama?}', function ($nama = 'Semua') {
    // ↑ '/sapa/{nama}' = URL pattern
    // ↑ {nama}         = Parameter dinamis, nilainya dari URL
    // ↑ function($nama) = Parameter diterima di function

    return "Halo, $nama! Selamat datang di Toko Online.";
    // ↑ "$nama" = Variable interpolation (masukkan nilai $nama ke string)
});

// CARA AKSES:
// http://localhost:8000/sapa/Budi
// Output: "Halo, Budi! Selamat datang di Toko Online."

// http://localhost:8000/sapa/Ani
// Output: "Halo, Ani! Selamat datang di Toko Online."