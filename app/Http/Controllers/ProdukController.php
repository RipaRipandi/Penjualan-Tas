<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = Produk::query();

        // Filter pencarian
        if ($request->filled('q')) {
            $query->where(function($q) use ($request) {
                $q->where('nama_tas', 'like', '%' . $request->q . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->q . '%');
            });
        }

        // Filter stok
        if ($request->stok == 'tersedia') {
            $query->where('stok', '>', 0);
        } elseif ($request->stok == 'habis') {
            $query->where('stok', 0);
        }

        // Sort harga
        if ($request->sort == 'harga_asc') {
            $query->orderBy('harga', 'asc');
        } elseif ($request->sort == 'harga_desc') {
            $query->orderBy('harga', 'desc');
        } else {
            $query->latest();
        }

        $produks = $query->get();

        if (request()->is('admin/*')) {
            return view('admin.produk.index', compact('produks'));
        }

        return view('produk.index', compact('produks'));
    }

    public function create()
    {
        return view('admin.produk.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_tas'  => 'required|string|max:255',
            'harga'     => 'required|numeric',
            'stok'      => 'required|integer',
            'deskripsi' => 'nullable|string',
            'gambar'    => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $gambar = $request->file('gambar')->store('produk', 'public');

        Produk::create([
            'nama_tas'  => $request->nama_tas,
            'harga'     => $request->harga,
            'stok'      => $request->stok,
            'deskripsi' => $request->deskripsi,
            'gambar'    => $gambar
        ]);

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_tas'  => 'required|string|max:255',
            'harga'     => 'required|numeric',
            'stok'      => 'required|integer',
            'deskripsi' => 'nullable|string',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['nama_tas', 'harga', 'stok', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        $produk->update($data);

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil diupdate');
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.detail', compact('produk'));
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil dihapus');
    }

    public function search(Request $request)
    {
        // Redirect ke index dengan query string supaya filter tetap jalan
        return redirect()->route('produk.index', ['q' => $request->q]);
    }
}