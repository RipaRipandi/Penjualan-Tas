@extends('layouts.main')
@section('content')

<div class="min-h-screen bg-green-50 py-16 flex items-center">
    <div class="container mx-auto px-4">
        <div class="max-w-lg mx-auto">
            <div class="bg-white rounded-2xl border border-green-100 shadow-sm p-10 text-center">

                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-envelope text-green-700 text-2xl"></i>
                </div>

                <h3 class="text-2xl font-extrabold text-green-700 mb-3">Verifikasi Email</h3>

                @if(session('resent'))
                    <div class="bg-green-100 text-green-700 font-medium px-5 py-4 rounded-xl mb-6">
                        ✓ Link verifikasi baru sudah dikirim ke email Anda
                    </div>
                @endif

                <p class="text-gray-500 text-sm leading-relaxed mb-6">
                    Sebelum melanjutkan, silakan cek email Anda untuk link verifikasi.<br>
                    Jika belum menerima email,
                </p>

                <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit"
                            class="bg-gradient-to-r from-green-800 to-green-500 text-white font-bold
                                   py-3 px-8 rounded-xl hover:-translate-y-1 hover:shadow-lg
                                   transition-all border-0 cursor-pointer text-sm">
                        Kirim Ulang Email Verifikasi
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection