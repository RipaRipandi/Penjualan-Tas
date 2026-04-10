<?php

namespace App\Http\Controllers;

use App\Models\Produk;

class WelcomeController extends Controller
{
    public function index()
    {
        // Tampilkan max 8 produk terbaru di halaman welcome
        $produks = Produk::latest()->take(8)->get();

        return view('welcome', compact('produks'));
    }
}