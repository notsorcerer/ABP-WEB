@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    {{-- Hero Section --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-accent via-accent to-secondary">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-72 h-72 bg-primary rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-96 h-96 bg-secondary rounded-full blur-3xl"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="animate-fade-in">
                    <span class="inline-block px-3 py-1 bg-primary/20 text-primary text-xs font-semibold rounded-full mb-4">Welcome to LiquidPedia</span>
                    <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight mb-4">
                        Find Your 
                        <span class="text-primary">Perfect Vibe</span>
                    </h1>
                    <p class="text-gray-300 text-lg mb-8 leading-relaxed">
                        Temukan koleksi liquid dan vape terbaik dengan flavor yang bikin kamu ketagihan. 
                        Dijamin original, harga bersahabat!
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('products.index') }}" 
                           class="inline-flex items-center gap-2 bg-primary text-white px-8 py-3 rounded-full font-semibold hover:bg-secondary transition-all duration-300 hover:shadow-lg hover:shadow-primary/25">
                            Lihat Produk
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                        <a href="#best-seller" 
                           class="inline-flex items-center gap-2 border-2 border-white/20 text-white px-8 py-3 rounded-full font-semibold hover:bg-white/10 transition-all duration-300">
                            Best Seller
                        </a>
                    </div>
                </div>
                <div class="hidden md:block animate-fade-in animate-delay-200">
                    <div class="relative">
                        <div class="w-80 h-80 mx-auto bg-gradient-to-br from-primary/30 to-secondary/30 rounded-full blur-3xl absolute -top-10 -left-10"></div>
                        <div class="relative bg-white/5 backdrop-blur-sm rounded-2xl p-8 border border-white/10">
                            <div class="text-center">
                                <div class="text-6xl mb-4">💨</div>
                                <h3 class="text-white text-xl font-bold mb-2">Vape Your Way</h3>
                                <p class="text-gray-400 text-sm">Ribuan flavor siap menemani harimu</p>
                            </div>
                            <div class="grid grid-cols-2 gap-3 mt-6">
                                <div class="bg-white/10 rounded-xl p-3 text-center">
                                    <div class="text-2xl font-bold text-primary">50+</div>
                                    <div class="text-xs text-gray-400">Varian Liquid</div>
                                </div>
                                <div class="bg-white/10 rounded-xl p-3 text-center">
                                    <div class="text-2xl font-bold text-primary">20+</div>
                                    <div class="text-xs text-gray-400">Device Vape</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Best Seller Section --}}
    <section id="best-seller" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
        <div class="text-center mb-12 animate-fade-in">
            <span class="inline-block px-3 py-1 bg-primary/10 text-primary text-xs font-semibold rounded-full mb-3">Top Picks</span>
            <h2 class="text-3xl md:text-4xl font-bold text-accent">Best Seller</h2>
            <p class="text-gray-500 mt-3 max-w-md mx-auto">Produk favorit yang paling laris dan banyak dicari</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($bestSellers as $index => $product)
                <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 hover:-translate-y-2 animate-fade-in" style="animation-delay: {{ $index * 100 }}ms">
                    <a href="{{ route('products.show', $product) }}" class="block">
                        <div class="aspect-[4/3] overflow-hidden bg-gray-100">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                 loading="lazy">
                        </div>
                    </a>
                    <div class="p-4">
                        <span class="text-xs font-semibold text-primary bg-primary/10 px-2 py-1 rounded-full">{{ $product->category->name }}</span>
                        <a href="{{ route('products.show', $product) }}">
                            <h3 class="font-semibold text-accent mt-2 mb-1 group-hover:text-primary transition-colors duration-200 line-clamp-2">{{ $product->name }}</h3>
                        </a>
                        <p class="text-primary font-bold text-lg">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-3">
                            @csrf
                            <button type="submit" 
                                    class="w-full bg-primary hover:bg-secondary text-white py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 hover:shadow-lg hover:shadow-primary/25 flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Tambah ke Cart
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('products.index') }}?category=all" 
               class="inline-flex items-center gap-2 text-primary hover:text-secondary font-semibold transition-colors duration-200">
                Lihat Semua Produk
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>
    </section>

    {{-- Categories Section --}}
    <section class="bg-white py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-fade-in">
                <span class="inline-block px-3 py-1 bg-primary/10 text-primary text-xs font-semibold rounded-full mb-3">Categories</span>
                <h2 class="text-3xl md:text-4xl font-bold text-accent">Pilih Kategori</h2>
                <p class="text-gray-500 mt-3">Temukan produk berdasarkan kategori yang kamu suka</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($categories as $index => $category)
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}" 
                       class="group relative overflow-hidden rounded-2xl h-64 animate-fade-in" style="animation-delay: {{ $index * 100 }}ms">
                        @if ($category->slug === 'vape')
                            <div class="absolute inset-0 bg-gradient-to-br from-accent to-secondary"></div>
                        @else
                            <div class="absolute inset-0 bg-gradient-to-br from-primary to-secondary"></div>
                        @endif
                        <div class="absolute inset-0 opacity-20">
                            <div class="absolute top-5 right-5 w-40 h-40 bg-white rounded-full blur-3xl"></div>
                        </div>
                        <div class="relative h-full flex flex-col items-center justify-center text-white p-8">
                            <div class="text-5xl mb-4 group-hover:scale-110 transition-transform duration-500">
                                @if ($category->slug === 'vape')
                                    💨
                                @else
                                    🧴
                                @endif
                            </div>
                            <h3 class="text-3xl font-bold mb-2">{{ $category->name }}</h3>
                            <p class="text-white/70 text-sm">Lihat koleksi {{ $category->name }}</p>
                            <span class="mt-4 inline-flex items-center gap-2 text-sm font-semibold bg-white/20 px-4 py-2 rounded-full group-hover:bg-white/30 transition-all duration-300">
                                Jelajahi
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Banner Section --}}
    <section class="relative overflow-hidden bg-gradient-to-r from-primary via-secondary to-accent py-20">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-1/4 w-80 h-80 bg-white rounded-full blur-3xl"></div>
        </div>
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center animate-fade-in">
            <h2 class="text-3xl md:text-5xl font-bold text-white mb-4 leading-tight">
                FIND FLAVORS THAT MATCH YOUR <span class="text-accent bg-white/10 px-3 rounded-lg">VIBE</span>
            </h2>
            <p class="text-white/70 text-lg mb-8 max-w-2xl mx-auto">
                Dari fruity hingga dessert, temukan flavor yang paling cocok dengan kepribadianmu. 
                Setiap hisapan adalah pengalaman baru!
            </p>
            <a href="{{ route('products.index') }}" 
               class="inline-flex items-center gap-2 bg-white text-primary px-8 py-3 rounded-full font-bold hover:bg-gray-100 transition-all duration-300 hover:shadow-xl hover:scale-105">
                Explore Now
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>
    </section>

    {{-- New Arrival Section --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
        <div class="text-center mb-12 animate-fade-in">
            <span class="inline-block px-3 py-1 bg-primary/10 text-primary text-xs font-semibold rounded-full mb-3">New Arrivals</span>
            <h2 class="text-3xl md:text-4xl font-bold text-accent">Produk Terbaru</h2>
            <p class="text-gray-500 mt-3 max-w-md mx-auto">Koleksi terbaru yang baru aja mendarat</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($newArrivals as $index => $product)
                <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 hover:-translate-y-2 animate-fade-in" style="animation-delay: {{ $index * 100 }}ms">
                    <div class="relative">
                        <a href="{{ route('products.show', $product) }}" class="block">
                            <div class="aspect-[4/3] overflow-hidden bg-gray-100">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                     loading="lazy">
                            </div>
                        </a>
                        <span class="absolute top-3 left-3 bg-primary text-white text-xs font-bold px-2 py-1 rounded-full">BARU</span>
                    </div>
                    <div class="p-4">
                        <span class="text-xs font-semibold text-primary bg-primary/10 px-2 py-1 rounded-full">{{ $product->category->name }}</span>
                        <a href="{{ route('products.show', $product) }}">
                            <h3 class="font-semibold text-accent mt-2 mb-1 group-hover:text-primary transition-colors duration-200 line-clamp-2">{{ $product->name }}</h3>
                        </a>
                        <p class="text-primary font-bold text-lg">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-3">
                            @csrf
                            <button type="submit" 
                                    class="w-full bg-primary hover:bg-secondary text-white py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 hover:shadow-lg hover:shadow-primary/25 flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Tambah ke Cart
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('products.index') }}" 
               class="inline-flex items-center gap-2 text-primary hover:text-secondary font-semibold transition-colors duration-200">
                Lihat Semua Produk
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>
    </section>
@endsection
