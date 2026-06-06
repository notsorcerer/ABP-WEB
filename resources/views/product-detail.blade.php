@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-8">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors duration-200">Beranda</a>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
            <a href="{{ route('products.index') }}" class="hover:text-primary transition-colors duration-200">Produk</a>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
            <span class="text-accent font-medium truncate">{{ $product->name }}</span>
        </nav>

        <div class="grid md:grid-cols-2 gap-8 lg:gap-12">
            <div class="animate-fade-in">
                <div class="aspect-square rounded-2xl overflow-hidden bg-gray-100 shadow-lg">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
                </div>
            </div>
            <div class="animate-fade-in animate-delay-200">
                <div class="flex flex-wrap items-center gap-2 mb-4">
                    <span class="text-xs font-semibold text-primary bg-primary/10 px-3 py-1.5 rounded-full">{{ $product->category->name }}</span>
                    @if ($product->is_best_seller)
                        <span class="text-xs font-semibold text-amber-600 bg-amber-50 px-3 py-1.5 rounded-full">Best Seller</span>
                    @endif
                    @if ($product->is_new_arrival)
                        <span class="text-xs font-semibold text-green-600 bg-green-50 px-3 py-1.5 rounded-full">New Arrival</span>
                    @endif
                </div>
                <h1 class="text-3xl lg:text-4xl font-bold text-accent mb-4">{{ $product->name }}</h1>
                <p class="text-3xl font-bold text-primary mb-6">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                <div class="prose prose-sm max-w-none text-gray-600 mb-8">
                    <p>{{ $product->description }}</p>
                </div>
                <form action="{{ route('cart.add', $product) }}" method="POST" class="flex items-center gap-4 mb-8">
                    @csrf
                    <div class="flex items-center border-2 border-gray-200 rounded-xl overflow-hidden">
                        <button type="button" class="qty-minus px-4 py-3 text-gray-500 hover:text-primary hover:bg-gray-50 transition-all duration-200 font-medium">−</button>
                        <input type="number" name="quantity" value="1" min="1" 
                               class="qty-input w-16 text-center py-3 border-x-2 border-gray-200 text-sm font-semibold outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                        <button type="button" class="qty-plus px-4 py-3 text-gray-500 hover:text-primary hover:bg-gray-50 transition-all duration-200 font-medium">+</button>
                    </div>
                    <button type="submit" 
                            class="flex-1 bg-primary hover:bg-secondary text-white py-3.5 px-8 rounded-xl font-semibold transition-all duration-300 hover:shadow-lg hover:shadow-primary/25 flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                        Tambah ke Cart
                    </button>
                </form>

                <div class="border-t border-gray-200 pt-6">
                    <h4 class="font-semibold text-accent mb-3">Detail Produk</h4>
                    <table class="text-sm text-gray-600">
                        <tr class="mb-2">
                            <td class="pr-8 py-1 text-gray-400">Kategori</td>
                            <td class="font-medium text-accent">{{ $product->category->name }}</td>
                        </tr>
                        <tr class="mb-2">
                            <td class="pr-8 py-1 text-gray-400">Status</td>
                            <td class="font-medium text-green-600">Stok Tersedia</td>
                        </tr>
                        <tr class="mb-2">
                            <td class="pr-8 py-1 text-gray-400">Garansi</td>
                            <td class="font-medium text-accent">100% Original</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.querySelectorAll('.qty-plus').forEach(btn => {
            btn.addEventListener('click', function() {
                const input = this.parentElement.querySelector('.qty-input');
                input.value = parseInt(input.value) + 1;
            });
        });
        document.querySelectorAll('.qty-minus').forEach(btn => {
            btn.addEventListener('click', function() {
                const input = this.parentElement.querySelector('.qty-input');
                if (parseInt(input.value) > 1) {
                    input.value = parseInt(input.value) - 1;
                }
            });
        });
    </script>
    @endpush
@endsection
