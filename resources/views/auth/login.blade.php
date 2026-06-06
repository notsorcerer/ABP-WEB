@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
    <div class="min-h-[80vh] flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md animate-fade-in">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-accent">Masuk</h1>
                <p class="text-gray-500 mt-2">Masuk ke akun LiquidPedia kamu</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="bg-white rounded-2xl p-8 shadow-sm">
                @csrf

                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-accent mb-1.5">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                           class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary focus:outline-none transition-colors duration-200 text-sm @error('email') border-red-400 @enderror"
                           placeholder="email@example.com" autofocus required>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-accent mb-1.5">Password</label>
                    <input type="password" name="password" id="password"
                           class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary focus:outline-none transition-colors duration-200 text-sm @error('password') border-red-400 @enderror"
                           placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-primary focus:ring-primary">
                        Ingat saya
                    </label>
                </div>

                <button type="submit"
                        class="w-full bg-primary hover:bg-secondary text-white py-3 px-8 rounded-xl font-semibold transition-all duration-300 hover:shadow-lg hover:shadow-primary/25 text-sm">
                    Masuk
                </button>

                <p class="text-center text-sm text-gray-500 mt-6">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-primary hover:text-secondary font-semibold transition-colors duration-200">Daftar</a>
                </p>
            </form>
        </div>
    </div>
@endsection
