@extends('layouts.main')
@section('content')

<div class="min-h-screen bg-green-50 py-16">
    <div class="container mx-auto px-4">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-10">
            <div>
                <h2 class="text-4xl font-extrabold text-green-700 mb-2 inline-block relative
                            after:content-[''] after:absolute after:-bottom-3 after:left-0
                            after:w-20 after:h-1 after:bg-gradient-to-r after:from-green-700 after:to-green-400 after:rounded">
                    Semua Produk Tas
                </h2>
                <p class="text-gray-400 text-sm mt-4">
                    Menampilkan <span class="font-semibold text-green-700">{{ $produks->count() }}</span> produk
                </p>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 font-medium px-5 py-4 rounded-xl mb-6">
                ✓ {{ session('success') }}
            </div>
        @endif

        <!-- FILTER BAR -->
        <form method="GET" action="{{ url('/produk') }}"
              class="bg-white rounded-2xl border border-green-100 shadow-sm p-5 mb-8">
            <div class="flex flex-col md:flex-row gap-4">

                <!-- Search -->
                <div class="flex-1 relative">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input type="text" name="q" value="{{ request('q') }}"
                           placeholder="Cari nama atau deskripsi tas..."
                           class="w-full pl-10 pr-4 py-3 border border-green-100 rounded-xl text-sm text-gray-800
                                  focus:outline-none focus:border-green-600 focus:ring-2 focus:ring-green-100 transition-all">
                </div>

                <!-- Sort Harga -->
                <div class="md:w-52">
                    <select name="sort"
                            class="w-full px-4 py-3 border border-green-100 rounded-xl text-sm text-gray-700
                                   focus:outline-none focus:border-green-600 transition-all bg-white">
                        <option value="">Urutkan Harga</option>
                        <option value="harga_asc"  {{ request('sort') == 'harga_asc'  ? 'selected' : '' }}>Harga: Terendah</option>
                        <option value="harga_desc" {{ request('sort') == 'harga_desc' ? 'selected' : '' }}>Harga: Tertinggi</option>
                    </select>
                </div>

                <!-- Stok Filter -->
                <div class="md:w-44">
                    <select name="stok"
                            class="w-full px-4 py-3 border border-green-100 rounded-xl text-sm text-gray-700
                                   focus:outline-none focus:border-green-600 transition-all bg-white">
                        <option value="">Semua Stok</option>
                        <option value="tersedia" {{ request('stok') == 'tersedia' ? 'selected' : '' }}>Stok Tersedia</option>
                        <option value="habis"    {{ request('stok') == 'habis'    ? 'selected' : '' }}>Stok Habis</option>
                    </select>
                </div>

                <!-- Tombol -->
                <div class="flex gap-2">
                    <button type="submit"
                            class="bg-green-700 hover:bg-green-600 text-white font-bold px-6 py-3 rounded-xl
                                   transition-all border-0 cursor-pointer text-sm whitespace-nowrap">
                        <i class="fas fa-filter mr-1"></i> Filter
                    </button>
                    <a href="{{ url('/produk') }}"
                       class="bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold px-4 py-3 rounded-xl
                              transition-all text-sm no-underline whitespace-nowrap flex items-center">
                        Reset
                    </a>
                </div>
            </div>
        </form>

        <!-- GRID PRODUK -->
        @if($produks->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-7">
                @foreach($produks as $produk)
                <div class="bg-white rounded-2xl overflow-hidden border border-green-100 shadow-sm
                            hover:-translate-y-2 hover:shadow-xl hover:border-green-400
                            transition-all duration-300 flex flex-col">

                    <div class="relative h-64 overflow-hidden bg-gradient-to-br from-green-50 to-green-100">
                        @if($produk->gambar)
                            <img src="{{ asset('storage/' . $produk->gambar) }}"
                                 alt="{{ $produk->nama_tas }}" loading="lazy"
                                 class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                        @else
                            <img src="https://via.placeholder.com/400x300?text={{ urlencode($produk->nama_tas) }}"
                                 alt="{{ $produk->nama_tas }}" class="w-full h-full object-cover">
                        @endif
                        <span class="absolute top-3 left-3 bg-gradient-to-r from-green-800 to-green-500
                                     text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                            Original
                        </span>
                        @if($produk->stok == 0)
                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                                <span class="bg-red-500 text-white font-bold text-sm px-4 py-2 rounded-full">Stok Habis</span>
                            </div>
                        @endif
                    </div>

                    <div class="p-5 flex flex-col flex-1">
                        <h3 class="text-base font-bold text-gray-900 mb-2 leading-snug">{{ $produk->nama_tas }}</h3>
                        <p class="text-sm text-gray-400 mb-3 leading-relaxed font-light flex-1">{{ $produk->deskripsi }}</p>
                        <p class="text-xs text-gray-400 mb-4">
                            Stok:
                            @if($produk->stok > 0)
                                <span class="text-green-700 font-semibold">{{ $produk->stok }} Tersedia</span>
                            @else
                                <span class="text-red-500 font-semibold">Habis</span>
                            @endif
                        </p>
                        <div class="flex items-center justify-between pt-4 border-t border-green-50">
                            <span class="text-xl font-extrabold text-green-700">
                                Rp {{ number_format($produk->harga, 0, ',', '.') }}
                            </span>
                            <a href="{{ url('/produk/'.$produk->id_produk) }}"
                               class="bg-green-700 hover:bg-green-600 text-white text-sm font-bold
                                      py-2.5 px-4 rounded-xl hover:-translate-y-0.5 hover:shadow-md
                                      transition-all duration-300 no-underline">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-2xl shadow-sm">
                <i class="fas fa-search text-4xl text-gray-300 mb-4 block"></i>
                <h5 class="text-xl font-bold text-gray-500 mb-2">Produk Tidak Ditemukan</h5>
                <p class="text-gray-400 text-sm">Coba kata kunci atau filter yang berbeda</p>
            </div>
        @endif

    </div>
</div>

@endsection