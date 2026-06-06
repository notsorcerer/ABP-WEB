@extends('layouts.app')

@section('title', 'Cart')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-accent">Shopping Cart</h1>
                <p class="text-gray-500 mt-1">Review pesanan kamu sebelum checkout</p>
            </div>
        </div>

        @if ($products->isEmpty())
            <div class="text-center py-20 animate-fade-in">
                <div class="text-7xl mb-6">🛒</div>
                <h3 class="text-2xl font-semibold text-accent mb-3">Cart masih kosong</h3>
                <p class="text-gray-500 mb-8">Yuk tambah produk favoritmu!</p>
                <a href="{{ route('products.index') }}" 
                   class="inline-flex items-center gap-2 bg-primary hover:bg-secondary text-white px-8 py-3 rounded-full font-semibold transition-all duration-300 hover:shadow-lg hover:shadow-primary/25">
                    Mulai Belanja
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        @else
            <div class="grid lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-4">
                    @foreach ($products as $product)
                        <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm hover:shadow-md transition-all duration-300 animate-fade-in flex flex-col sm:flex-row gap-4">
                            <div class="w-full sm:w-24 h-24 rounded-xl overflow-hidden bg-gray-100 shrink-0">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <span class="text-xs font-semibold text-primary bg-primary/10 px-2 py-1 rounded-full">{{ $product->category->name }}</span>
                                        <h3 class="font-semibold text-accent mt-1">{{ $product->name }}</h3>
                                        <p class="text-primary font-bold mt-1">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                    </div>
                                    <form action="{{ route('cart.remove', $product) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                                <div class="flex items-center justify-between mt-3">
                                    <form action="{{ route('cart.update', $product) }}" method="POST" class="flex items-center gap-3">
                                        @csrf
                                        <div class="flex items-center border-2 border-gray-200 rounded-xl overflow-hidden">
                                            <button type="button" class="qty-minus px-3 py-2 text-gray-500 hover:text-primary hover:bg-gray-50 transition-all duration-200">−</button>
                                            <input type="number" name="quantity" value="{{ $product->quantity }}" min="1" 
                                                   class="qty-input w-14 text-center py-2 border-x-2 border-gray-200 text-sm font-semibold outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                            <button type="button" class="qty-plus px-3 py-2 text-gray-500 hover:text-primary hover:bg-gray-50 transition-all duration-200">+</button>
                                        </div>
                                        <button type="submit" class="text-xs text-primary hover:text-secondary font-semibold transition-colors duration-200">Update</button>
                                    </form>
                                    <p class="text-accent font-bold">Rp{{ number_format($product->subtotal, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="animate-fade-in animate-delay-200">
                    <div class="bg-white rounded-2xl p-6 shadow-sm sticky top-24">
                        <h3 class="text-lg font-bold text-accent mb-4">Ringkasan Pesanan</h3>
                        <div class="space-y-3 text-sm">
                            @foreach ($products as $product)
                                <div class="flex justify-between text-gray-600">
                                    <span class="truncate mr-2">{{ $product->name }} x{{ $product->quantity }}</span>
                                    <span class="font-medium">Rp{{ number_format($product->subtotal, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="border-t border-gray-200 mt-4 pt-4">
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-accent">Total</span>
                                <span class="text-xl font-bold text-primary">Rp{{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <a href="{{ route('checkout') }}"
                           class="w-full bg-primary hover:bg-secondary text-white py-3.5 px-8 rounded-xl font-semibold transition-all duration-300 hover:shadow-lg hover:shadow-primary/25 flex items-center justify-center gap-2 text-sm mt-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            Checkout
                        </a>
                        <a href="{{ route('products.index') }}" 
                           class="block text-center text-sm text-primary hover:text-secondary font-semibold mt-4 transition-colors duration-200">
                            Lanjut Belanja
                        </a>
                    </div>
                </div>
            </div>
        @endif
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
