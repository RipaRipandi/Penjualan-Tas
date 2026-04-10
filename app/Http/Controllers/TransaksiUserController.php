<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;

class TransaksiUserController extends Controller
{
    // Daftar semua transaksi milik user yang login
    public function riwayat()
    {
        $transaksis = Transaksi::with('details.produk')
            ->where('id_user', Auth::id())
            ->latest('created_at')
            ->get();

        return view('transaksi.riwayat', compact('transaksis'));
    }

    // Detail satu transaksi
    public function detail($id)
    {
        $transaksi = Transaksi::with('details.produk')
            ->where('id_transaksi', $id)
            ->where('id_user', Auth::id()) // pastikan milik user ini
            ->firstOrFail();

        return view('transaksi.detail', compact('transaksi'));
    }
}