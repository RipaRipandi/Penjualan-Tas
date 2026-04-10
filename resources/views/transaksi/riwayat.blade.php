@extends('layouts.main')
@section('content')

<div class="min-h-screen bg-green-50 py-16">
    <div class="container mx-auto px-4">

        <h2 class="text-4xl font-extrabold text-green-700 mb-2 inline-block relative
                    after:content-[''] after:absolute after:-bottom-3 after:left-0
                    after:w-20 after:h-1 after:bg-gradient-to-r after:from-green-700 after:to-green-400 after:rounded">
            Riwayat Belanja
        </h2>

        @if(session('success'))
            <div class="mt-8 bg-green-100 text-green-700 font-medium px-5 py-4 rounded-xl">✓ {{ session('success') }}</div>
        @endif

        @if($transaksis->count() > 0)
            <div class="mt-12 space-y-6">
                @foreach($transaksis as $t)
                <div class="bg-white rounded-2xl border border-green-100 shadow-sm overflow-hidden">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between
                                bg-gradient-to-r from-green-800 to-green-600 px-6 py-4 gap-3">
                        <div>
                            <span class="text-white font-bold">Order #{{ $t->id_transaksi }}</span>
                            <span class="text-white/70 text-sm ml-3">
                                {{ \Carbon\Carbon::parse($t->tanggal)->format('d M Y') }}
                            </span>
                        </div>
                        <div>
                            @if($t->status == 'pending')
                                <span class="bg-yellow-400 text-yellow-900 text-xs font-bold px-4 py-1.5 rounded-full">Pending</span>
                            @elseif($t->status == 'sukses')
                                <span class="bg-green-400 text-green-900 text-xs font-bold px-4 py-1.5 rounded-full">Sukses</span>
                            @else
                                <span class="bg-red-400 text-red-900 text-xs font-bold px-4 py-1.5 rounded-full">Batal</span>
                            @endif
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="bg-green-50 text-gray-500 text-xs uppercase tracking-wide">
                                        <th class="px-4 py-3 text-left font-semibold">Produk</th>
                                        <th class="px-4 py-3 text-left font-semibold">Harga</th>
                                        <th class="px-4 py-3 text-left font-semibold">Jumlah</th>
                                        <th class="px-4 py-3 text-left font-semibold">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($t->details as $detail)
                                    <tr class="border-t border-green-50">
                                        <td class="px-4 py-3 text-gray-800 font-medium">{{ $detail->produk->nama_tas ?? '-' }}</td>
                                        <td class="px-4 py-3 text-gray-600">Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 text-gray-600">{{ $detail->jumlah }}</td>
                                        <td class="px-4 py-3 font-bold text-green-700">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-right mt-4 pt-4 border-t border-green-50">
                            <span class="text-gray-500 font-medium">Total: </span>
                            <span class="text-2xl font-black text-green-700">
                                Rp {{ number_format($t->total_harga, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-2xl shadow-sm mt-12">
                <h5 class="text-xl font-bold text-gray-500 mb-6">Belum ada transaksi</h5>
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