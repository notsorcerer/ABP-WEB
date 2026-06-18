<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'LiquidPedia') - LiquidPedia</title>

    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    @stack('styles')
</head>
<body class="font-sans bg-bg text-accent antialiased min-h-screen flex flex-col">
    @php
        $cart = session()->get('cart', []);
        $cartCount = array_sum($cart);
    @endphp

    <nav class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-200/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                    <span class="text-2xl font-bold text-primary group-hover:text-secondary transition-colors duration-300">Liquid</span>
                    <span class="text-2xl font-bold text-accent">Pedia</span>
                </a>

                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-accent/70 hover:text-primary transition-colors duration-200 {{ request()->routeIs('home') ? 'text-primary' : '' }}">
                        Beranda
                    </a>
                    <a href="{{ route('products.index') }}" class="text-sm font-medium text-accent/70 hover:text-primary transition-colors duration-200 {{ request()->routeIs('products.*') ? 'text-primary' : '' }}">
                        Produk
                    </a>
                    <form action="{{ route('products.index') }}" method="GET" class="relative">
                        <input type="text" name="search" placeholder="Cari produk..."
                               class="w-44 lg:w-52 pl-9 pr-3 py-1.5 text-sm bg-gray-100 rounded-full border border-transparent focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"
                               value="{{ request('search') }}">
                        <svg class="absolute left-2.5 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </form>
                    <a href="{{ route('cart.index') }}" class="relative text-sm font-medium text-accent/70 hover:text-primary transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                        @if ($cartCount > 0)
                            <span class="absolute -top-2 -right-2 bg-primary text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center animate-fade-in">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>

                    @auth
                        <div class="relative group">
                            <button class="flex items-center gap-2 text-sm font-medium text-accent/70 hover:text-primary transition-colors duration-200">
                                <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary text-sm font-bold">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <div class="py-2">
                                    <div class="px-4 py-2 border-b border-gray-100">
                                        <p class="text-sm font-semibold text-accent truncate">{{ auth()->user()->name }}</p>
                                        <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                                    </div>
                                    <a href="{{ route('profile') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                                        Profil
                                    </a>
                                    <a href="{{ route('orders') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707V19a2 2 0 0 1-2 2Z" /></svg>
                                        Pesanan
                                    </a>
                                    <div class="border-t border-gray-100 mt-1 pt-1">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="flex items-center gap-2 w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" /></svg>
                                                Keluar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-accent/70 hover:text-primary transition-colors duration-200">Masuk</a>
                        <a href="{{ route('register') }}" class="text-sm font-medium bg-primary hover:bg-secondary text-white px-4 py-2 rounded-full transition-all duration-300 hover:shadow-lg hover:shadow-primary/25">Daftar</a>
                    @endauth
                </div>

                <div class="flex items-center gap-3 md:hidden">
                    <a href="{{ route('cart.index') }}" class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-accent/70" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                        @if ($cartCount > 0)
                            <span class="absolute -top-2 -right-2 bg-primary text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                    <button id="mobile-menu-btn" class="text-accent/70">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>
            </div>

            <div id="mobile-menu" class="hidden md:hidden pb-4 border-t border-gray-100 pt-4">
                <div class="flex flex-col gap-3">
                    <form action="{{ route('products.index') }}" method="GET" class="relative">
                        <input type="text" name="search" placeholder="Cari produk..."
                               class="w-full pl-9 pr-3 py-2 text-sm bg-gray-100 rounded-full border border-transparent focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"
                               value="{{ request('search') }}">
                        <svg class="absolute left-2.5 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </form>
                    <a href="{{ route('home') }}" class="text-sm font-medium text-accent/70 hover:text-primary transition-colors duration-200 {{ request()->routeIs('home') ? 'text-primary' : '' }}">Beranda</a>
                    <a href="{{ route('products.index') }}" class="text-sm font-medium text-accent/70 hover:text-primary transition-colors duration-200 {{ request()->routeIs('products.*') ? 'text-primary' : '' }}">Produk</a>
                    @auth
                        <a href="{{ route('profile') }}" class="text-sm font-medium text-accent/70 hover:text-primary transition-colors duration-200">Profil</a>
                        <a href="{{ route('orders') }}" class="text-sm font-medium text-accent/70 hover:text-primary transition-colors duration-200">Pesanan</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm font-medium text-red-500 hover:text-red-700 transition-colors duration-200">Keluar</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-accent/70 hover:text-primary transition-colors duration-200">Masuk</a>
                        <a href="{{ route('register') }}" class="text-sm font-medium text-accent/70 hover:text-primary transition-colors duration-200">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-1">
        @if (session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm animate-fade-in">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        @if (session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm animate-fade-in">
                    {{ session('error') }}
                </div>
            </div>
        @endif
        @yield('content')
    </main>

    <footer class="bg-accent text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">
                        <span class="text-primary">Liquid</span>Pedia
                    </h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Toko liquid dan vape terpercaya dengan produk original dan berkualitas. Vibe your flavor, find your match!
                    </p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4 text-sm uppercase tracking-wider text-gray-300">Navigasi</h4>
                    <div class="flex flex-col gap-2">
                        <a href="{{ route('home') }}" class="text-gray-400 hover:text-white text-sm transition-colors duration-200">Beranda</a>
                        <a href="{{ route('products.index') }}" class="text-gray-400 hover:text-white text-sm transition-colors duration-200">Produk</a>
                        <a href="{{ route('cart.index') }}" class="text-gray-400 hover:text-white text-sm transition-colors duration-200">Cart</a>
                    </div>
                </div>
                <div>
                    <h4 class="font-semibold mb-4 text-sm uppercase tracking-wider text-gray-300">Kontak</h4>
                    <div class="flex flex-col gap-2 text-sm text-gray-400">
                        <span>WhatsApp: 0821-9148-8380</span>
                        <span>Email: hello@liquidpedia.id</span>
                        <span>Jam operasional: 09:00 - 21:00 WIB</span>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700/50 mt-8 pt-8 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} LiquidPedia. All rights reserved.
            </div>
        </div>
    </footer>

    <a href="https://wa.me/6282191488380" target="_blank" rel="noopener noreferrer"
       class="fixed bottom-6 right-6 bg-green-500 text-white p-3.5 rounded-full shadow-lg hover:bg-green-600 transition-all duration-300 hover:scale-110 hover:shadow-xl z-50 animate-float"
       aria-label="Hubungi via WhatsApp">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
    </a>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    @stack('scripts')
    <script>
        document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
