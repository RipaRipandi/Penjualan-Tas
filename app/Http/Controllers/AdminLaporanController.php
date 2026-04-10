<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminLaporanController extends Controller
{
    public function index(Request $request)
    {
        $dari   = $request->dari   ?? now()->startOfMonth()->toDateString();
        $sampai = $request->sampai ?? now()->toDateString();

        // Total pendapatan periode ini
        $totalPendapatan = Transaksi::where('status', 'sukses')
            ->whereBetween('tanggal', [$dari, $sampai])
            ->sum('total_harga');

        // Total transaksi sukses
        $totalSukses = Transaksi::where('status', 'sukses')
            ->whereBetween('tanggal', [$dari, $sampai])
            ->count();

        // Total transaksi batal
        $totalBatal = Transaksi::where('status', 'batal')
            ->whereBetween('tanggal', [$dari, $sampai])
            ->count();

        // Total transaksi pending
        $totalPending = Transaksi::where('status', 'pending')
            ->whereBetween('tanggal', [$dari, $sampai])
            ->count();

        // Pendapatan per hari dalam periode
        $pendapatanHarian = DB::table('transactions')
            ->where('status', 'sukses')
            ->whereBetween('tanggal', [$dari, $sampai])
            ->selectRaw('tanggal, SUM(total_harga) as total, COUNT(*) as jumlah')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        // Produk terlaris (berdasarkan jumlah terjual)
        $produkTerlaris = DB::table('transaction_details')
            ->join('transactions', 'transaction_details.id_transaksi', '=', 'transactions.id_transaksi')
            ->join('products', 'transaction_details.id_produk', '=', 'products.id_produk')
            ->where('transactions.status', 'sukses')
            ->whereBetween('transactions.tanggal', [$dari, $sampai])
            ->selectRaw('products.nama_tas, SUM(transaction_details.jumlah) as total_terjual, SUM(transaction_details.subtotal) as total_pendapatan')
            ->groupBy('products.id_produk', 'products.nama_tas')
            ->orderByDesc('total_terjual')
            ->take(10)
            ->get();

        // Stok menipis
        $stokMenipis = Produk::where('stok', '<=', 5)->orderBy('stok')->get();

        return view('admin.laporan.index', compact(
            'dari', 'sampai',
            'totalPendapatan', 'totalSukses', 'totalBatal', 'totalPending',
            'pendapatanHarian', 'produkTerlaris', 'stokMenipis'
        ));
    }
}