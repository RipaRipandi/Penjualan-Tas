<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\Produk;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjang = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return view('keranjang.index', compact('keranjang'));
    }

    public function add($id)
    {
        $produk = Produk::findOrFail($id);

        $item = CartItem::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->first();

        if ($item) {
            $item->increment('qty');
        } else {
            CartItem::create([
                'user_id'    => Auth::id(),
                'product_id' => $produk->id_produk,
                'qty'        => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang');
    }

    public function remove($id)
    {
        CartItem::where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        return redirect()->back()->with('success', 'Produk dihapus dari keranjang');
    }

    public function update(Request $request, $id)
    {
        $qty = (int) $request->qty;

        $item = CartItem::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$item) {
            return back()->with('error', 'Item tidak ditemukan');
        }

        if ($qty < 1) {
            $item->delete();
        } else {
            $item->update(['qty' => $qty]);
        }

        return back()->with('success', 'Keranjang diperbarui');
    }
}