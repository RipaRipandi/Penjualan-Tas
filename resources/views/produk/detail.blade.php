@extends('layouts.main')
@section('content')

<div class="min-h-screen bg-green-50 py-16">
    <div class="container mx-auto px-4">

        <a href="{{ url()->previous() }}"
           class="inline-block mb-8 bg-green-100 text-green-700 font-semibold px-5 py-2.5 rounded-lg
                  hover:bg-green-700 hover:text-white transition-all duration-300 no-underline">
            ← Kembali
        </a>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 font-medium px-5 py-4 rounded-xl mb-6">✓ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 text-red-600 font-medium px-5 py-4 rounded-xl mb-6">✕ {{ session('error') }}</div>
        @endif

        <div class="bg-white rounded-2xl border border-green-100 shadow-sm p-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

                <!-- Gambar -->
                <div class="flex items-center justify-center bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-10 min-h-[400px]">
                    @if($produk->gambar)
                        <img src="{{ asset('storage/' . $produk->gambar) }}"
                             alt="{{ $produk->nama_tas }}"
                             class="w-full max-h-[450px] object-cover rounded-xl">
                    @else
                        <img src="https://via.placeholder.com/500x400?text=No+Image"
                             alt="No Image" class="w-full max-h-[450px] object-cover rounded-xl">
                    @endif
                </div>

                <!-- Info -->
                <div class="flex flex-col justify-center">
                    <h1 class="text-3xl font-extrabold text-gray-900 mb-4">{{ $produk->nama_tas }}</h1>
                    <div class="text-4xl font-black text-green-700 mb-5">
                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                    </div>
                    <p class="text-gray-400 text-base leading-relaxed font-light mb-6">{{ $produk->deskripsi }}</p>

                    <div class="bg-green-50 border-l-4 border-green-700 rounded-xl px-5 py-4 mb-7">
                        <div class="flex justify-between items-center">
                            <span class="font-semibold text-gray-800">Status Stok:</span>
                            @if($produk->stok > 0)
                                <span class="bg-green-100 text-green-700 font-bold text-sm px-4 py-1.5 rounded-full">
                                    {{ $produk->stok }} Tersedia
                                </span>
                            @else
                                <span class="bg-red-100 text-red-600 font-bold text-sm px-4 py-1.5 rounded-full">
                                    Stok Habis
                                </span>
                            @endif
                        </div>
                    </div>

                    @auth
                        @if($produk->stok > 0)
                            <div class="flex gap-4 flex-wrap">
                                <form action="{{ route('keranjang.tambah', $produk->id_produk) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit"
                                            class="w-full bg-green-700 hover:bg-green-600 text-white font-bold
                                                   py-4 px-6 rounded-xl hover:-translate-y-1 hover:shadow-lg
                                                   transition-all duration-300 border-0 cursor-pointer text-base">
                                        Tambah ke Keranjang
                                    </button>
                                </form>
                                <form action="{{ route('checkout.beli.sekarang', $produk->id_produk) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit"
                                            class="w-full bg-gradient-to-r from-green-800 to-green-500 text-white font-bold
                                                   py-4 px-6 rounded-xl hover:-translate-y-1 hover:shadow-lg
                                                   transition-all duration-300 border-0 cursor-pointer text-base">
                                        Beli Sekarang
                                    </button>
                                </form>
                            </div>
                        @else
                            <button disabled
                                    class="w-full bg-gray-300 text-white font-bold py-4 px-6 rounded-xl cursor-not-allowed text-base">
                                Stok Habis
                            </button>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                           class="block text-center bg-green-700 hover:bg-green-600 text-white font-bold
                                  py-4 px-6 rounded-xl hover:-translate-y-1 hover:shadow-lg
                                  transition-all duration-300 no-underline text-base">
                            Masuk untuk Membeli
                        </a>
                    @endauth
                </div>

            </div>
        </div>

    </div>
</div>

@endsection