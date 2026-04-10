@extends('layouts.main')
@section('content')

<div class="min-h-screen bg-green-50 py-16">
    <div class="container mx-auto px-4">

        <h1 class="text-4xl font-extrabold text-green-700 text-center mb-2">Hubungi Kami</h1>
        <div class="w-20 h-1 bg-gradient-to-r from-green-800 to-green-400 rounded-full mx-auto mb-12"></div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 font-medium px-5 py-4 rounded-xl mb-6">
                ✓ Pesan Anda telah terkirim. Terima kasih telah menghubungi kami!
            </div>
        @endif
        @if($errors->any())
            <div class="bg-red-100 text-red-600 font-medium px-5 py-4 rounded-xl mb-6">
                ✕ Terjadi kesalahan. Silakan coba lagi.
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <div class="bg-white rounded-2xl border border-green-100 shadow-sm p-8">
                <h3 class="text-xl font-bold text-green-700 mb-7">Informasi Kontak</h3>
                <div class="space-y-6">
                    <div>
                        <span class="block font-bold text-gray-800 mb-1">Alamat</span>
                        <span class="text-gray-400 font-light leading-relaxed">
                            Jl. Pendidikan No. 123<br>Banjar, Jawa Barat 46511<br>Indonesia
                        </span>
                    </div>
                    <div>
                        <span class="block font-bold text-gray-800 mb-1">Telepon</span>
                        <a href="tel:+6281234567890" class="text-green-700 font-semibold hover:text-green-500 no-underline">
                            +62 812-3456-7890
                        </a>
                    </div>
                    <div>
                        <span class="block font-bold text-gray-800 mb-1">Email</span>
                        <a href="mailto:support@penjualantas.com" class="text-green-700 font-semibold hover:text-green-500 no-underline">
                            support@penjualantas.com
                        </a>
                    </div>
                    <div>
                        <span class="block font-bold text-gray-800 mb-1">Jam Operasional</span>
                        <span class="text-gray-400 font-light leading-relaxed">
                            Senin - Jumat: 08:00 - 17:00<br>Sabtu: 09:00 - 15:00<br>Minggu: Tutup
                        </span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-green-100 shadow-sm p-8">
                <h3 class="text-xl font-bold text-green-700 mb-7">Kirim Pesan</h3>
                <form action="#" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block font-bold text-gray-800 text-sm mb-2">Nama Lengkap</label>
                        <input type="text" name="nama" placeholder="Masukkan nama Anda" required
                               class="w-full px-4 py-3 border-2 border-green-100 rounded-xl text-gray-800
                                      focus:outline-none focus:border-green-600 focus:bg-green-50 transition-all">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-800 text-sm mb-2">Email</label>
                        <input type="email" name="email" placeholder="Masukkan email Anda" required
                               class="w-full px-4 py-3 border-2 border-green-100 rounded-xl text-gray-800
                                      focus:outline-none focus:border-green-600 focus:bg-green-50 transition-all">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-800 text-sm mb-2">Nomor Telepon</label>
                        <input type="tel" name="telepon" placeholder="Masukkan nomor telepon" required
                               class="w-full px-4 py-3 border-2 border-green-100 rounded-xl text-gray-800
                                      focus:outline-none focus:border-green-600 focus:bg-green-50 transition-all">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-800 text-sm mb-2">Pesan</label>
                        <textarea name="pesan" rows="5" placeholder="Tuliskan pesan Anda di sini..." required
                                  class="w-full px-4 py-3 border-2 border-green-100 rounded-xl text-gray-800
                                         focus:outline-none focus:border-green-600 focus:bg-green-50 transition-all resize-y"></textarea>
                    </div>
                    <button type="submit"
                            class="w-full bg-gradient-to-r from-green-800 to-green-500 text-white font-bold
                                   py-4 rounded-xl hover:-translate-y-1 hover:shadow-lg transition-all border-0 cursor-pointer text-base">
                        Kirim Pesan
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection