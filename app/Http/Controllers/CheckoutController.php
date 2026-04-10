<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\Produk;

class CheckoutController extends Controller
{
    /**
     * Checkout dari keranjang (semua item)
     */
    public function proses()
    {
        $keranjang = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($keranjang->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kosong, tidak bisa checkout');
        }

        return $this->simpanTransaksi($keranjang, hapusKeranjang: true);
    }

    /**
     * Beli Sekarang — checkout langsung 1 produk tanpa lewat keranjang
     */
    public function beliSekarang($id_produk)
    {
        $produk = Produk::findOrFail($id_produk);

        if ($produk->stok < 1) {
            return redirect()->back()->with('error', 'Stok produk habis');
        }

        // Bungkus jadi format yang sama seperti CartItem collection
        $items = collect([[
            'product'    => $produk,
            'product_id' => $produk->id_produk,
            'qty'        => 1,
        ]]);

        return $this->simpanTransaksiArray($items);
    }

    /**
     * Proses simpan transaksi dari keranjang (Collection CartItem)
     */
    private function simpanTransaksi($keranjang, bool $hapusKeranjang = false)
    {
        DB::beginTransaction();

        try {
            // Validasi stok semua dulu
            foreach ($keranjang as $item) {
                if (!$item->product) {
                    throw new \Exception('Produk tidak ditemukan');
                }
                if ($item->product->stok < $item->qty) {
                    throw new \Exception(
                        'Stok tidak cukup untuk: ' . $item->product->nama_tas .
                        '. Tersedia: ' . $item->product->stok
                    );
                }
            }

            $total = $keranjang->sum(fn($item) => $item->product->harga * $item->qty);

            $idTransaksi = DB::table('transactions')->insertGetId([
                'id_user'     => Auth::id(),
                'tanggal'     => now()->toDateString(),
                'total_harga' => $total,
                'status'      => 'sukses',
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);

            foreach ($keranjang as $item) {
                DB::table('transaction_details')->insert([
                    'id_transaksi' => $idTransaksi,
                    'id_produk'    => $item->product_id,
                    'jumlah'       => $item->qty,
                    'harga'        => $item->product->harga,
                    'subtotal'     => $item->product->harga * $item->qty,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);

                $item->product->decrement('stok', $item->qty);
            }

            if ($hapusKeranjang) {
                CartItem::where('user_id', Auth::id())->delete();
            }

            DB::commit();

            return redirect()->route('transaksi.riwayat')
                ->with('success', 'Checkout berhasil! Terima kasih sudah belanja 🎉');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Proses simpan transaksi dari array biasa (untuk Beli Sekarang)
     */
    private function simpanTransaksiArray($items)
    {
        DB::beginTransaction();

        try {
            foreach ($items as $item) {
                if ($item['product']->stok < $item['qty']) {
                    throw new \Exception(
                        'Stok tidak cukup untuk: ' . $item['product']->nama_tas .
                        '. Tersedia: ' . $item['product']->stok
                    );
                }
            }

            $total = collect($items)->sum(fn($item) => $item['product']->harga * $item['qty']);

            $idTransaksi = DB::table('transactions')->insertGetId([
                'id_user'     => Auth::id(),
                'tanggal'     => now()->toDateString(),
                'total_harga' => $total,
                'status'      => 'sukses',
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);

            foreach ($items as $item) {
                DB::table('transaction_details')->insert([
                    'id_transaksi' => $idTransaksi,
                    'id_produk'    => $item['product_id'],
                    'jumlah'       => $item['qty'],
                    'harga'        => $item['product']->harga,
                    'subtotal'     => $item['product']->harga * $item['qty'],
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);

                $item['product']->decrement('stok', $item['qty']);
            }

            DB::commit();

            return redirect()->route('transaksi.riwayat')
                ->with('success', 'Pembelian berhasil! Terima kasih sudah belanja 🎉');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}