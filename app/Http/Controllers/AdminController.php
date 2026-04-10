<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $totalProduk      = Produk::count();
        $totalUser        = User::where('role', 'user')->count();
        $totalTransaksi   = Transaksi::count();
        $totalPendapatan  = Transaksi::where('status', 'sukses')->sum('total_harga');
        $transaksiPending = Transaksi::where('status', 'pending')->count();
        $stokMenipis      = Produk::where('stok', '<=', 5)->count();
        $transaksiTerbaru = Transaksi::with('user')->latest('created_at')->take(5)->get();

        // Pendapatan per hari (7 hari terakhir)
        $pendapatanHarian = DB::table('transactions')
            ->where('status', 'sukses')
            ->where('tanggal', '>=', now()->subDays(7)->toDateString())
            ->selectRaw('tanggal, SUM(total_harga) as total')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        return view('admin.dashboard', compact(
            'totalProduk',
            'totalUser',
            'totalTransaksi',
            'totalPendapatan',
            'transaksiPending',
            'stokMenipis',
            'transaksiTerbaru',
            'pendapatanHarian'
        ));
    }
}