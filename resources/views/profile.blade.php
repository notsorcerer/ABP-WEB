@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-accent">Profil Saya</h1>
            <p class="text-gray-500 mt-1">Informasi akun kamu</p>
        </div>

        <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm animate-fade-in">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center text-primary text-2xl font-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <h2 class="text-xl font-bold text-accent">{{ auth()->user()->name }}</h2>
                    <p class="text-gray-500 text-sm">Pelanggan</p>
                </div>
            </div>

            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Nama Lengkap</label>
                    <p class="text-accent font-semibold">{{ auth()->user()->name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                    <p class="text-accent font-semibold">{{ auth()->user()->email }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Member Sejak</label>
                    <p class="text-accent font-semibold">{{ auth()->user()->created_at->format('d F Y') }}</p>
                </div>
            </div>

            <div class="border-t border-gray-200 mt-8 pt-6">
                <a href="{{ route('orders') }}"
                   class="inline-flex items-center gap-2 text-primary hover:text-secondary font-semibold text-sm transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707V19a2 2 0 0 1-2 2Z" />
                    </svg>
                    Lihat Pesanan Saya
                </a>
            </div>
        </div>
    </div>
@endsection
