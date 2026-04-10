@extends('layouts.main')
@section('content')

<div class="min-h-screen bg-green-50 py-16 flex items-center">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto">
            <div class="bg-white rounded-2xl border border-green-100 shadow-sm p-10">

                <h3 class="text-2xl font-extrabold text-green-700 text-center mb-2">Konfirmasi Password</h3>
                <p class="text-center text-gray-400 text-sm mb-8">Masukkan password untuk melanjutkan</p>

                <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block font-bold text-gray-800 text-sm mb-2">Password</label>
                        <input type="password" name="password" required
                               class="w-full px-4 py-3 border-2 border-green-100 rounded-xl text-gray-800
                                      focus:outline-none focus:border-green-600 focus:bg-green-50 transition-all
                                      @error('password') border-red-400 @enderror">
                        @error('password')<small class="text-red-500 text-xs mt-1 block">{{ $message }}</small>@enderror
                    </div>
                    <button type="submit"
                            class="w-full bg-gradient-to-r from-green-800 to-green-500 text-white font-bold
                                   py-4 rounded-full hover:-translate-y-1 hover:shadow-lg transition-all border-0 cursor-pointer text-base">
                        Konfirmasi
                    </button>
                </form>

                @if(Route::has('password.request'))
                    <div class="text-center mt-5">
                        <a href="{{ route('password.request') }}" class="text-red-500 text-sm hover:underline no-underline">Lupa Password?</a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>

@endsection