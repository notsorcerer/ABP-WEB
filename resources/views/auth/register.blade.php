@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
    <div class="min-h-[80vh] flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md animate-fade-in">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-accent">Daftar</h1>
                <p class="text-gray-500 mt-2">Buat akun LiquidPedia baru</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="bg-white rounded-2xl p-8 shadow-sm">
                @csrf

                <div class="mb-5">
                    <label for="name" class="block text-sm font-medium text-accent mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                           class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary focus:outline-none transition-colors duration-200 text-sm @error('name') border-red-400 @enderror"
                           placeholder="Nama Kamu" required autofocus>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-accent mb-1.5">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                           class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary focus:outline-none transition-colors duration-200 text-sm @error('email') border-red-400 @enderror"
                           placeholder="email@example.com" required>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="block text-sm font-medium text-accent mb-1.5">Password</label>
                    <input type="password" name="password" id="password"
                           class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary focus:outline-none transition-colors duration-200 text-sm @error('password') border-red-400 @enderror"
                           placeholder="Minimal 8 karakter" required>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-accent mb-1.5">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary focus:outline-none transition-colors duration-200 text-sm"
                           placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required>
                </div>

                <button type="submit"
                        class="w-full bg-primary hover:bg-secondary text-white py-3 px-8 rounded-xl font-semibold transition-all duration-300 hover:shadow-lg hover:shadow-primary/25 text-sm">
                    Daftar
                </button>

                <p class="text-center text-sm text-gray-500 mt-6">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-primary hover:text-secondary font-semibold transition-colors duration-200">Masuk</a>
                </p>
            </form>
        </div>
    </div>
@endsection
