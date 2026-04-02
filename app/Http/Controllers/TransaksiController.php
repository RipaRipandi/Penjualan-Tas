<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransaksiDetail;
use App\Models\Transaction;  // Perhatikan ini harus Transaction, bukan Transa atau Transaksi
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function index()
    {
        $details = TransaksiDetail::with('transaction', 'product')->latest()->get();

        return response()->json([
            'message' => 'Data detail transaksi berhasil diambil',
            'data' => $details
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_transaksi' => 'required|exists:transactions,id_transaksi',
            'id_produk'    => 'required|exists:products,id_produk',
            'jumlah'       => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        $product = Product::find($request->id_produk);

        if ($product->stok < $request->jumlah) {
            return response()->json([
                'message' => 'Stok tidak cukup'
            ], 400);
        }

        $subtotal = $product->harga * $request->jumlah;

        $detail = TransaksiDetail::create([
            'id_transaksi' => $request->id_transaksi,
            'id_produk'    => $request->id_produk,
            'jumlah'       => $request->jumlah,
            'harga'        => $product->harga,
            'subtotal'     => $subtotal
        ]);

        $product->decrement('stok', $request->jumlah);

        return response()->json([
            'message' => 'Detail transaksi berhasil ditambahkan',
            'data' => $detail->load('product')
        ], 201);
    }

    public function show($id)
    {
        $detail = TransaksiDetail::with('transaction', 'product')->find($id);

        if (!$detail) {
            return response()->json([
                'message' => 'Detail tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'message' => 'Detail transaksi',
            'data' => $detail
        ]);
    }

    public function update(Request $request, $id)
    {
        $detail = TransaksiDetail::find($id);

        if (!$detail) {
            return response()->json([
                'message' => 'Detail tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'jumlah' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        $product = Product::find($detail->id_produk);

        // kembalikan stok lama ke product
        $product->increment('stok', $detail->jumlah);

        if ($product->stok < $request->jumlah) {
            return response()->json([
                'message' => 'Stok tidak cukup'
            ], 400);
        }

        $subtotal = $product->harga * $request->jumlah;

        $detail->update([
            'jumlah'   => $request->jumlah,
            'harga'    => $product->harga,
            'subtotal' => $subtotal
        ]);

        $product->decrement('stok', $request->jumlah);

        return response()->json([
            'message' => 'Detail transaksi berhasil diupdate',
            'data' => $detail
        ]);
    }

    public function destroy($id)
    {
        $detail = TransaksiDetail::find($id);

        if (!$detail) {
            return response()->json([
                'message' => 'Detail tidak ditemukan'
            ], 404);
        }

        $product = Product::find($detail->id_produk);
        $product->increment('stok', $detail->jumlah);

        $detail->delete();

        return response()->json([
            'message' => 'Detail transaksi berhasil dihapus'
        ]);
    }
}