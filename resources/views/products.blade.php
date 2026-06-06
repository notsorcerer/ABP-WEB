@extends('layouts.app')

@section('title', 'Produk')

@section('content')
    <div class="bg-white border-b border-gray-200/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-accent">Semua Produk</h1>
                    <p class="text-gray-500 mt-1">Temukan liquid dan vape favoritmu</p>
                </div>
            </div>

            <div class="flex flex-wrap gap-2 mt-6">
                <a href="{{ route('products.index', ['category' => 'all']) }}"
                   class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 {{ $selectedCategory === 'all' ? 'bg-primary text-white shadow-md shadow-primary/25' : 'bg-gray-100 text-accent/70 hover:bg-gray-200' }}">
                    Semua
                </a>
                @foreach ($categories as $cat)
                    <a href="{{ route('products.index', ['category' => $cat->slug]) }}"
                       class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 {{ $selectedCategory === $cat->slug ? 'bg-primary text-white shadow-md shadow-primary/25' : 'bg-gray-100 text-accent/70 hover:bg-gray-200' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if ($products->isEmpty())
            <div class="text-center py-20">
                <div class="text-6xl mb-4">😕</div>
                <h3 class="text-xl font-semibold text-accent mb-2">Produk tidak ditemukan</h3>
                <p class="text-gray-500">Tidak ada produk di kategori ini</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($products as $index => $product)
                    <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 hover:-translate-y-2 animate-fade-in" style="animation-delay: {{ $index % 4 * 100 }}ms">
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
        @endif
    </div>
@endsection
