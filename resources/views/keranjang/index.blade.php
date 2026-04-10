@extends('layouts.main')
@section('content')

<div class="min-h-screen bg-green-50 py-16">
    <div class="container mx-auto px-4">

        <h2 class="text-4xl font-extrabold text-green-700 mb-2 inline-block relative
                    after:content-[''] after:absolute after:-bottom-3 after:left-0
                    after:w-20 after:h-1 after:bg-gradient-to-r after:from-green-700 after:to-green-400 after:rounded">
            Keranjang Belanja
        </h2>

        @if(session('success'))
            <div class="mt-8 bg-green-100 text-green-700 font-medium px-5 py-4 rounded-xl">✓ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mt-4 bg-red-100 text-red-600 font-medium px-5 py-4 rounded-xl">✕ {{ session('error') }}</div>
        @endif

        @if($keranjang && $keranjang->count() > 0)

            <div class="bg-white rounded-2xl border border-green-100 shadow-sm overflow-hidden mt-12">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gradient-to-r from-green-800 to-green-500 text-white">
                            <tr>
                                <th class="px-6 py-4 text-left font-bold text-sm tracking-wide">Produk</th>
                                <th class="px-6 py-4 text-left font-bold text-sm tracking-wide">Harga</th>
                                <th class="px-6 py-4 text-left font-bold text-sm tracking-wide">Jumlah</th>
                                <th class="px-6 py-4 text-left font-bold text-sm tracking-wide">Subtotal</th>
                                <th class="px-6 py-4 text-left font-bold text-sm tracking-wide">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach($keranjang as $item)
                            @php $subtotal = $item->product->harga * $item->qty; $total += $subtotal; @endphp
                            <tr class="border-b border-green-50 hover:bg-green-50 transition-colors">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-4">
                                        @if($item->product->gambar)
                                            <img src="{{ asset('storage/' . $item->product->gambar) }}"
                                                 class="w-16 h-16 rounded-xl object-cover border border-green-100"
                                                 alt="{{ $item->product->nama_tas }}">
                                        @else
                                            <img src="https://via.placeholder.com/80x80?text=No+Image"
                                                 class="w-16 h-16 rounded-xl object-cover" alt="No Image">
                                        @endif
                                        <a href="{{ url('/produk/'.$item->product->id_produk) }}"
                                           class="font-bold text-gray-900 hover:text-green-700 transition-colors no-underline">
                                            {{ $item->product->nama_tas }}
                                        </a>
                                    </div>
                                </td>
                                <td class="px-6 py-5 font-bold text-green-700">
                                    Rp {{ number_format($item->product->harga, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-5">
                                    <form action="{{ route('keranjang.update', $item->id) }}" method="POST"
                                          class="flex items-center gap-2">
                                        @csrf
                                        <input type="number" name="qty" value="{{ $item->qty }}" min="1"
                                               class="w-16 px-3 py-2 border border-green-200 rounded-lg font-semibold
                                                      text-gray-800 focus:outline-none focus:border-green-600 text-sm">
                                        <button type="submit"
                                                class="bg-green-700 hover:bg-green-600 text-white text-xs font-bold
                                                       px-3 py-2 rounded-lg transition-all border-0 cursor-pointer">
                                            Perbarui
                                        </button>
                                    </form>
                                </td>
                                <td class="px-6 py-5 font-bold text-green-700">
                                    Rp {{ number_format($subtotal, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-5">
                                    <a href="{{ route('keranjang.remove', $item->id) }}"
                                       onclick="return confirm('Hapus item ini dari keranjang?')"
                                       class="bg-red-100 hover:bg-red-200 text-red-600 font-bold text-xs
                                              px-4 py-2 rounded-lg transition-all no-underline">
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-green-100 shadow-sm p-7 mt-6
                        flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                <div>
                    <p class="text-gray-500 font-medium text-sm mb-1">Total Harga:</p>
                    <div class="text-3xl font-black text-green-700">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </div>
                </div>
                <form action="{{ route('checkout.proses') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="bg-gradient-to-r from-green-800 to-green-500 text-white font-bold
                                   py-4 px-12 rounded-xl hover:-translate-y-1 hover:shadow-lg
                                   transition-all duration-300 border-0 cursor-pointer text-base whitespace-nowrap">
                        Lanjut ke Pembayaran
                    </button>
                </form>
            </div>

        @else
            <div class="text-center py-20 bg-white rounded-2xl shadow-sm mt-12">
                <h4 class="text-2xl font-bold text-gray-800 mb-3">Keranjang Anda Kosong</h4>
                <p class="text-gray-400 mb-7">Belum ada produk yang ditambahkan ke keranjang</p>
                <a href="{{ url('/produk') }}"
                   class="inline-block bg-gradient-to-r from-green-800 to-green-500 text-white font-bold
                          py-4 px-10 rounded-xl hover:-translate-y-1 hover:shadow-lg transition-all no-underline">
                    Belanja Sekarang
                </a>
            </div>
        @endif

    </div>
</div>

@endsection