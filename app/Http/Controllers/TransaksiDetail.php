<?php

namespace App\Http\Controllers;

use App\Models\TransaksiDetail;
use Illuminate\Http\Request;

class TransaksiDetailController extends Controller
{
    public function index()
    {
        $details = TransaksiDetail::with(['produk', 'transaksi'])->get();
        return response()->json($details);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_transaksi' => 'required|exists:transaksis,id_transaksi',
            'id_produk' => 'required|exists:products,id_produk',
            'qty' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
        ]);

        $validated['subtotal'] = $validated['qty'] * $validated['harga_satuan'];

        $detail = TransaksiDetail::create($validated);

        return response()->json([
            'message' => 'Detail transaksi berhasil dibuat',
            'data' => $detail
        ], 201);
    }

    public function show($id)
    {
        $detail = TransaksiDetail::with(['produk', 'transaksi'])->findOrFail($id);
        return response()->json($detail);
    }

    public function update(Request $request, $id)
    {
        $detail = TransaksiDetail::findOrFail($id);

        $validated = $request->validate([
            'qty' => 'sometimes|integer|min:1',
            'harga_satuan' => 'sometimes|numeric|min:0',
        ]);

        if (isset($validated['qty'])) {
            $detail->qty = $validated['qty'];
        }
        if (isset($validated['harga_satuan'])) {
            $detail->harga_satuan = $validated['harga_satuan'];
        }

        if (isset($validated['qty']) || isset($validated['harga_satuan'])) {
            $detail->subtotal = $detail->qty * $detail->harga_satuan;
        }

        $detail->save();

        return response()->json([
            'message' => 'Detail transaksi berhasil diperbarui',
            'data' => $detail
        ]);
    }

    public function destroy($id)
    {
        $detail = TransaksiDetail::findOrFail($id);
        $detail->delete();

        return response()->json([
            'message' => 'Detail transaksi berhasil dihapus',
        ]);
    }
}