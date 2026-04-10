@extends('layouts.main')
@section('content')

<div class="min-h-screen bg-green-50 py-16 flex items-center">
    <div class="container mx-auto px-4">
        <div class="max-w-lg mx-auto">
            <div class="bg-white rounded-2xl border border-green-100 shadow-sm p-10">

                <h3 class="text-2xl font-extrabold text-green-700 text-center mb-8">Daftar Akun</h3>

                @if($errors->any())
                    <div class="bg-red-100 text-red-600 font-medium px-5 py-4 rounded-xl mb-6">Ada kesalahan pada input</div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block font-bold text-gray-800 text-sm mb-2">Nama</label>
                        <input type="text" name="nama" value="{{ old('nama') }}" required
                               class="w-full px-4 py-3 border-2 border-green-100 rounded-xl text-gray-800
                                      focus:outline-none focus:border-green-600 focus:bg-green-50 transition-all
                                      @error('nama') border-red-400 @enderror">
                        @error('nama')<small class="text-red-500 text-xs mt-1 block">{{ $message }}</small>@enderror
                    </div>
                    <div>
                        <label class="block font-bold text-gray-800 text-sm mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="w-full px-4 py-3 border-2 border-green-100 rounded-xl text-gray-800
                                      focus:outline-none focus:border-green-600 focus:bg-green-50 transition-all
                                      @error('email') border-red-400 @enderror">
                        @error('email')<small class="text-red-500 text-xs mt-1 block">{{ $message }}</small>@enderror
                    </div>
                    <div>
                        <label class="block font-bold text-gray-800 text-sm mb-2">Alamat</label>
                        <textarea name="alamat" rows="3" required
                                  class="w-full px-4 py-3 border-2 border-green-100 rounded-xl text-gray-800
                                         focus:outline-none focus:border-green-600 focus:bg-green-50 transition-all resize-none
                                         @error('alamat') border-red-400 @enderror">{{ old('alamat') }}</textarea>
                        @error('alamat')<small class="text-red-500 text-xs mt-1 block">{{ $message }}</small>@enderror
                    </div>
                    <div>
                        <label class="block font-bold text-gray-800 text-sm mb-2">Password</label>
                        <input type="password" name="password" required
                               class="w-full px-4 py-3 border-2 border-green-100 rounded-xl text-gray-800
                                      focus:outline-none focus:border-green-600 focus:bg-green-50 transition-all
                                      @error('password') border-red-400 @enderror">
                        @error('password')<small class="text-red-500 text-xs mt-1 block">{{ $message }}</small>@enderror
                    </div>
                    <div>
                        <label class="block font-bold text-gray-800 text-sm mb-2">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required
                               class="w-full px-4 py-3 border-2 border-green-100 rounded-xl text-gray-800
                                      focus:outline-none focus:border-green-600 focus:bg-green-50 transition-all">
                    </div>
                    <button type="submit"
                            class="w-full bg-gradient-to-r from-green-800 to-green-500 text-white font-bold
                                   py-4 rounded-full hover:-translate-y-1 hover:shadow-lg transition-all border-0 cursor-pointer text-base">
                        Daftar
                    </button>
                </form>

                <div class="text-center mt-5">
                    <p class="text-sm text-gray-500">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-green-700 font-bold hover:underline no-underline">Login</a>
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection