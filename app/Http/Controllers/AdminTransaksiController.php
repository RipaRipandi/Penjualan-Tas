<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class AdminTransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaksi::with('user')->latest('created_at');

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $transaksis = $query->get();
        $statusFilter = $request->status;

        return view('admin.transaksi.index', compact('transaksis', 'statusFilter'));
    }

    public function show($id)
    {
        $transaksi = Transaksi::with(['user', 'details.produk'])->findOrFail($id);
        return view('admin.transaksi.show', compact('transaksi'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,sukses,batal',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status transaksi berhasil diupdate');
    }
}