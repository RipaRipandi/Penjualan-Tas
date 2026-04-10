<nav class="fixed top-0 left-0 right-0 z-50 bg-white shadow-md">

    <!-- Topbar -->
    <div class="hidden lg:block bg-green-700 py-2">
        <div class="container mx-auto px-4 flex justify-end">
            @auth
                <span class="text-white/90 text-sm font-medium">
                    Selamat datang, <strong class="text-white font-bold">{{ Auth::user()->nama }}</strong>
                </span>
            @else
                <span class="text-white/90 text-sm">
                    Silakan <a href="{{ route('login') }}" class="text-white font-bold hover:underline">masuk</a> untuk melanjutkan
                </span>
            @endauth
        </div>
    </div>

    <!-- Main Nav -->
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between py-4">

            <!-- Brand -->
            <a href="{{ url('/') }}" class="text-2xl font-black bg-gradient-to-r from-green-800 to-green-500
                                             bg-clip-text text-transparent no-underline shrink-0">
                Penjualan Tas
            </a>

            <!-- Desktop Menu -->
            <div class="hidden xl:flex items-center gap-1 mx-6">
                <a href="{{ url('/') }}"
                   class="px-4 py-2 rounded-lg text-gray-800 font-semibold text-sm
                          hover:bg-green-50 hover:text-green-800 transition-all duration-200 no-underline">
                    Beranda
                </a>
                <a href="{{ url('/produk') }}"
                   class="px-4 py-2 rounded-lg text-gray-800 font-semibold text-sm
                          hover:bg-green-50 hover:text-green-800 transition-all duration-200 no-underline">
                    Produk
                </a>
                @auth
                    <a href="{{ route('transaksi.riwayat') }}"
                       class="px-4 py-2 rounded-lg text-gray-800 font-semibold text-sm
                              hover:bg-green-50 hover:text-green-800 transition-all duration-200 no-underline">
                        Riwayat Belanja
                    </a>
                    @if(Auth::user()->role == 'admin')
                        <a href="{{ url('/admin/dashboard') }}"
                           class="px-4 py-2 rounded-lg text-gray-800 font-semibold text-sm
                                  hover:bg-green-50 hover:text-green-800 transition-all duration-200 no-underline">
                            Dashboard
                        </a>
                    @endif
                @endauth
                <a href="/contact"
                   class="px-4 py-2 rounded-lg text-gray-800 font-semibold text-sm
                          hover:bg-green-50 hover:text-green-800 transition-all duration-200 no-underline">
                    Kontak
                </a>
            </div>

            <!-- Search + Actions -->
            <div class="hidden xl:flex items-center gap-3">

                <!-- Search -->
                <form action="{{ route('produk.search') }}" method="GET"
                      class="flex items-center gap-2 bg-green-50 border border-green-200
                             rounded-full px-4 py-2 focus-within:border-green-600
                             focus-within:bg-white focus-within:ring-2 focus-within:ring-green-200 transition-all">
                    <input type="text" name="q" placeholder="Cari tas..."
                           value="{{ request('q') }}"
                           class="bg-transparent border-0 outline-none text-sm text-gray-800
                                  placeholder-gray-400 w-36 focus:w-44 transition-all duration-300">
                    <button type="submit" class="text-green-700 hover:text-green-500 transition-colors bg-transparent border-0 cursor-pointer p-0">
                        <i class="fas fa-search text-sm"></i>
                    </button>
                </form>

                <!-- Cart -->
                <a href="{{ route('keranjang.index') }}"
                   class="relative flex items-center justify-center w-11 h-11 rounded-xl
                          bg-green-50 border border-green-200 text-green-700
                          hover:bg-green-600 hover:text-white hover:border-green-600
                          hover:-translate-y-1 hover:shadow-lg transition-all duration-300 no-underline">
                    <i class="fas fa-shopping-cart text-base"></i>
                    @php
                        $totalItem = 0;
                        if(Auth::check()) {
                            $totalItem = \App\Models\CartItem::where('user_id', Auth::id())->sum('qty');
                        }
                    @endphp
                    @if($totalItem > 0)
                        <span class="absolute -top-2 -right-2 w-5 h-5 bg-green-700 text-white
                                     text-xs font-bold rounded-full flex items-center justify-center">
                            {{ $totalItem }}
                        </span>
                    @endif
                </a>

                <!-- User / Logout -->
                @guest
                    <a href="{{ route('login') }}"
                       class="flex items-center justify-center w-11 h-11 rounded-xl
                              bg-green-50 border border-green-200 text-green-700
                              hover:bg-green-600 hover:text-white hover:border-green-600
                              hover:-translate-y-1 hover:shadow-lg transition-all duration-300 no-underline">
                        <i class="fas fa-user text-base"></i>
                    </a>
                @endguest
                @auth
                    <form action="{{ route('logout') }}" method="POST" class="contents">
                        @csrf
                        <button type="submit"
                                class="flex items-center justify-center w-11 h-11 rounded-xl
                                       bg-green-50 border border-green-200 text-green-700
                                       hover:bg-green-600 hover:text-white hover:border-green-600
                                       hover:-translate-y-1 hover:shadow-lg transition-all duration-300
                                       cursor-pointer">
                            <i class="fas fa-sign-out-alt text-base"></i>
                        </button>
                    </form>
                @endauth
            </div>

            <!-- Mobile Toggler -->
            <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
                    class="xl:hidden flex items-center justify-center w-10 h-10 rounded-lg
                           border border-green-200 text-green-700 hover:bg-green-50 transition-all">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden xl:hidden pb-4 border-t border-green-50">
            <div class="flex flex-col gap-1 pt-3">
                <a href="{{ url('/') }}"
                   class="px-4 py-2.5 rounded-lg text-gray-800 font-semibold text-sm
                          hover:bg-green-50 hover:text-green-800 transition-all no-underline">
                    Beranda
                </a>
                <a href="{{ url('/produk') }}"
                   class="px-4 py-2.5 rounded-lg text-gray-800 font-semibold text-sm
                          hover:bg-green-50 hover:text-green-800 transition-all no-underline">
                    Produk
                </a>
                @auth
                    <a href="{{ route('transaksi.riwayat') }}"
                       class="px-4 py-2.5 rounded-lg text-gray-800 font-semibold text-sm
                              hover:bg-green-50 hover:text-green-800 transition-all no-underline">
                        Riwayat Belanja
                    </a>
                    @if(Auth::user()->role == 'admin')
                        <a href="{{ url('/admin/dashboard') }}"
                           class="px-4 py-2.5 rounded-lg text-gray-800 font-semibold text-sm
                                  hover:bg-green-50 hover:text-green-800 transition-all no-underline">
                            Dashboard
                        </a>
                    @endif
                @endauth
                <a href="/contact"
                   class="px-4 py-2.5 rounded-lg text-gray-800 font-semibold text-sm
                          hover:bg-green-50 hover:text-green-800 transition-all no-underline">
                    Kontak
                </a>

                <!-- Mobile Search -->
                <form action="{{ route('produk.search') }}" method="GET"
                      class="flex items-center gap-2 bg-green-50 border border-green-200
                             rounded-full px-4 py-2 mt-2 mx-0">
                    <input type="text" name="q" placeholder="Cari tas..." value="{{ request('q') }}"
                           class="bg-transparent border-0 outline-none text-sm text-gray-800
                                  placeholder-gray-400 flex-1">
                    <button type="submit" class="text-green-700 bg-transparent border-0 cursor-pointer p-0">
                        <i class="fas fa-search text-sm"></i>
                    </button>
                </form>

                <!-- Mobile Actions -->
                <div class="flex gap-3 mt-3 pt-3 border-t border-green-50">
                    <a href="{{ route('keranjang.index') }}"
                       class="relative flex items-center justify-center w-11 h-11 rounded-xl
                              bg-green-50 border border-green-200 text-green-700
                              hover:bg-green-600 hover:text-white transition-all no-underline">
                        <i class="fas fa-shopping-cart"></i>
                        @if($totalItem > 0)
                            <span class="absolute -top-2 -right-2 w-5 h-5 bg-green-700 text-white
                                         text-xs font-bold rounded-full flex items-center justify-center">
                                {{ $totalItem }}
                            </span>
                        @endif
                    </a>
                    @guest
                        <a href="{{ route('login') }}"
                           class="flex items-center justify-center w-11 h-11 rounded-xl
                                  bg-green-50 border border-green-200 text-green-700
                                  hover:bg-green-600 hover:text-white transition-all no-underline">
                            <i class="fas fa-user"></i>
                        </a>
                    @endguest
                    @auth
                        <form action="{{ route('logout') }}" method="POST" class="contents">
                            @csrf
                            <button type="submit"
                                    class="flex items-center justify-center w-11 h-11 rounded-xl
                                           bg-green-50 border border-green-200 text-green-700
                                           hover:bg-green-600 hover:text-white transition-all cursor-pointer">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Spacer buat fixed navbar -->
<div class="h-[72px] lg:h-[108px]"></div>