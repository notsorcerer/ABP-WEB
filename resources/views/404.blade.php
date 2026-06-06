@extends('layouts.app')

@section('title', 'Halaman Tidak Ditemukan')

@section('content')
    <div class="min-h-[70vh] flex items-center justify-center px-4">
        <div class="text-center max-w-lg animate-fade-in">
            <div class="text-8xl mb-6">💨</div>
            <h1 class="text-8xl font-black text-primary mb-2">404</h1>
            <h2 class="text-2xl font-bold text-accent mb-4">Halaman Tidak Ditemukan</h2>
            <p class="text-gray-500 mb-8 leading-relaxed">
                Ups! Halaman yang kamu cari seperti vapor, menghilang begitu saja. 
                Mungkin kamu salah route atau halaman ini sudah tidak ada.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center gap-2 bg-primary hover:bg-secondary text-white px-8 py-3 rounded-full font-semibold transition-all duration-300 hover:shadow-lg hover:shadow-primary/25">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Kembali ke Beranda
                </a>
                <a href="{{ route('products.index') }}" 
                   class="inline-flex items-center gap-2 border-2 border-primary text-primary px-8 py-3 rounded-full font-semibold hover:bg-primary hover:text-white transition-all duration-300">
                    Lihat Produk
                </a>
            </div>
        </div>
    </div>
@endsection
