@extends('layouts.main')
@section('content')

<!-- HERO -->
<section class="relative bg-gradient-to-br from-green-900 via-green-700 to-green-400 overflow-hidden py-24 mb-16" style="color:white;">
    <div class="absolute -top-40 -right-20 w-[500px] h-[500px] rounded-full bg-white/5"></div>
    <div class="absolute -bottom-32 -left-10 w-[400px] h-[400px] rounded-full bg-white/5"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-2xl">
            <h1 class="text-5xl font-black leading-tight mb-5 drop-shadow-lg" style="color:white;">
                Koleksi Tas Premium Pilihan Anda
            </h1>
            <p class="text-lg mb-8 leading-relaxed font-light" style="color:rgba(255,255,255,0.9);">
                Temukan rangkaian tas berkualitas tinggi dengan desain terkini dan terbaik.
                Dari kerja, kuliah, hingga travel—kami punya semuanya dengan harga terjangkau.
            </p>
            <a href="{{ url('/produk') }}"
               class="inline-block bg-white text-green-800 font-bold py-4 px-12 rounded-full
                      hover:bg-green-50 hover:-translate-y-1 hover:shadow-2xl
                      transition-all duration-300 text-base no-underline">
                Mulai Belanja Sekarang
            </a>
        </div>
    </div>
</section>

<!-- PRODUCTS -->
<section class="pb-20 bg-green-50">
    <div class="container mx-auto px-4">

        <div class="text-center mb-14">
            <h2 class="text-4xl font-extrabold text-gray-900 mb-3">Produk Unggulan Kami</h2>
            <div class="w-20 h-1 bg-gradient-to-r from-green-800 to-green-400 rounded-full mx-auto mb-4"></div>
            <p class="text-gray-400 text-base font-light">Pilihan tas berkualitas premium dengan desain modern dan harga bersahabat</p>
        </div>

        @if($produks->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-7">
                @foreach($produks as $produk)
                <div class="bg-white rounded-2xl overflow-hidden border border-green-100
                            shadow-sm hover:-translate-y-2 hover:shadow-xl hover:border-green-400
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
                    </div>

                    <div class="p-5 flex flex-col flex-1">
                        <h3 class="text-base font-bold text-gray-900 mb-2 leading-snug">{{ $produk->nama_tas }}</h3>
                        <p class="text-sm text-gray-400 mb-4 leading-relaxed font-light flex-1">{{ $produk->deskripsi }}</p>

                        <div class="flex items-end justify-between gap-3 pt-4 border-t border-green-50">
                            <div>
                                <span class="block text-xs text-gray-400 font-semibold uppercase tracking-wide mb-1">Harga</span>
                                <span class="text-xl font-extrabold text-green-700">
                                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                </span>
                            </div>
                            <a href="{{ url('/produk/'.$produk->id_produk) }}"
                               class="flex-1 flex items-center justify-center gap-2
                                      bg-gradient-to-r from-green-800 to-green-500
                                      text-white text-sm font-bold py-3 px-3 rounded-xl
                                      hover:from-green-900 hover:to-green-700 hover:-translate-y-0.5
                                      hover:shadow-md transition-all duration-300 no-underline">
                                <i class="fa fa-eye"></i> Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Tombol lihat semua -->
            <div class="text-center mt-12">
                <a href="{{ url('/produk') }}"
                   class="inline-block bg-white border-2 border-green-700 text-green-700 font-bold
                          py-4 px-12 rounded-full hover:bg-green-700 hover:text-white
                          hover:-translate-y-1 hover:shadow-lg transition-all duration-300 no-underline">
                    Lihat Semua Produk
                </a>
            </div>
        @else
            <div class="text-center py-16">
                <p class="text-gray-400 text-lg">Belum ada produk tersedia. Silakan kembali lagi nanti.</p>
            </div>
        @endif
    </div>
</section>

@endsection