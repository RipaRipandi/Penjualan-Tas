<!-- Footer -->
<footer class="bg-gradient-to-br from-green-900 via-green-800 to-green-700 text-white mt-auto">

    <!-- Main Footer -->
    <div class="container mx-auto px-4 py-14">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

            <!-- Brand -->
            <div class="lg:col-span-1">
                <h2 class="text-2xl font-black mb-4 text-white">Penjualan Tas</h2>
                <p class="text-white/70 text-sm leading-relaxed font-light mb-6">
                    Toko tas premium terpercaya dengan koleksi terlengkap. Kualitas terjamin, harga terjangkau, pengiriman cepat ke seluruh Indonesia.
                </p>
                <div class="flex gap-3">
                    <a href="#" class="w-9 h-9 rounded-lg bg-white/10 hover:bg-white/20 flex items-center justify-center transition-all hover:-translate-y-1">
                        <i class="fab fa-instagram text-sm"></i>
                    </a>
                    <a href="#" class="w-9 h-9 rounded-lg bg-white/10 hover:bg-white/20 flex items-center justify-center transition-all hover:-translate-y-1">
                        <i class="fab fa-facebook-f text-sm"></i>
                    </a>
                    <a href="#" class="w-9 h-9 rounded-lg bg-white/10 hover:bg-white/20 flex items-center justify-center transition-all hover:-translate-y-1">
                        <i class="fab fa-whatsapp text-sm"></i>
                    </a>
                    <a href="#" class="w-9 h-9 rounded-lg bg-white/10 hover:bg-white/20 flex items-center justify-center transition-all hover:-translate-y-1">
                        <i class="fab fa-tiktok text-sm"></i>
                    </a>
                </div>
            </div>

            <!-- Navigasi -->
            <div>
                <h4 class="font-bold text-base mb-5 text-white relative inline-block
                            after:content-[''] after:absolute after:-bottom-2 after:left-0
                            after:w-8 after:h-0.5 after:bg-green-400 after:rounded">
                    Navigasi
                </h4>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ url('/') }}" class="text-white/70 hover:text-white text-sm transition-colors no-underline hover:translate-x-1 inline-block transition-all">
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/produk') }}" class="text-white/70 hover:text-white text-sm transition-colors no-underline hover:translate-x-1 inline-block transition-all">
                            Produk
                        </a>
                    </li>
                    <li>
                        <a href="/contact" class="text-white/70 hover:text-white text-sm transition-colors no-underline hover:translate-x-1 inline-block transition-all">
                            Kontak
                        </a>
                    </li>
                    @auth
                    <li>
                        <a href="{{ route('transaksi.riwayat') }}" class="text-white/70 hover:text-white text-sm transition-colors no-underline hover:translate-x-1 inline-block transition-all">
                            Riwayat Belanja
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('keranjang.index') }}" class="text-white/70 hover:text-white text-sm transition-colors no-underline hover:translate-x-1 inline-block transition-all">
                            Keranjang
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>

            <!-- Kategori -->
            <div>
                <h4 class="font-bold text-base mb-5 text-white relative inline-block
                            after:content-[''] after:absolute after:-bottom-2 after:left-0
                            after:w-8 after:h-0.5 after:bg-green-400 after:rounded">
                    Kategori Tas
                </h4>
                <ul class="space-y-3">
                    <li><a href="{{ url('/produk') }}" class="text-white/70 hover:text-white text-sm no-underline hover:translate-x-1 inline-block transition-all">Tas Ransel</a></li>
                    <li><a href="{{ url('/produk') }}" class="text-white/70 hover:text-white text-sm no-underline hover:translate-x-1 inline-block transition-all">Tas Selempang</a></li>
                    <li><a href="{{ url('/produk') }}" class="text-white/70 hover:text-white text-sm no-underline hover:translate-x-1 inline-block transition-all">Tas Travel</a></li>
                    <li><a href="{{ url('/produk') }}" class="text-white/70 hover:text-white text-sm no-underline hover:translate-x-1 inline-block transition-all">Tas Laptop</a></li>
                    <li><a href="{{ url('/produk') }}" class="text-white/70 hover:text-white text-sm no-underline hover:translate-x-1 inline-block transition-all">Tas Wanita</a></li>
                </ul>
            </div>

            <!-- Kontak -->
            <div>
                <h4 class="font-bold text-base mb-5 text-white relative inline-block
                            after:content-[''] after:absolute after:-bottom-2 after:left-0
                            after:w-8 after:h-0.5 after:bg-green-400 after:rounded">
                    Hubungi Kami
                </h4>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <i class="fas fa-map-marker-alt text-green-400 mt-0.5 text-sm shrink-0"></i>
                        <span class="text-white/70 text-sm leading-relaxed">
                            Jl. Pendidikan No. 123<br>Banjar, Jawa Barat 46511
                        </span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fas fa-phone-alt text-green-400 text-sm shrink-0"></i>
                        <a href="tel:+6281234567890" class="text-white/70 hover:text-white text-sm no-underline transition-colors">
                            +62 812-3456-7890
                        </a>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fas fa-envelope text-green-400 text-sm shrink-0"></i>
                        <a href="mailto:support@penjualantas.com" class="text-white/70 hover:text-white text-sm no-underline transition-colors">
                            support@penjualantas.com
                        </a>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-clock text-green-400 mt-0.5 text-sm shrink-0"></i>
                        <span class="text-white/70 text-sm leading-relaxed">
                            Sen–Jum: 08.00–17.00<br>Sabtu: 09.00–15.00
                        </span>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <!-- Divider -->
    <div class="border-t border-white/10">
        <div class="container mx-auto px-4 py-5 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-white/50 text-xs text-center sm:text-left">
                &copy; {{ date('Y') }} Penjualan Tas. All rights reserved.
            </p>
            <p class="text-white/50 text-xs">
                Made with <span class="text-red-400">♥</span> in Banjar, Jawa Barat
            </p>
        </div>
    </div>

</footer>