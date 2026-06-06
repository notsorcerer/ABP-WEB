@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-accent">Pesanan Saya</h1>
            <p class="text-gray-500 mt-1">Daftar pesanan yang sudah kamu buat</p>
        </div>

        @if ($orders->isEmpty())
            <div class="bg-white rounded-2xl p-12 shadow-sm animate-fade-in text-center">
                <div class="text-6xl mb-4">📦</div>
                <h3 class="text-xl font-semibold text-accent mb-2">Belum Ada Pesanan</h3>
                <p class="text-gray-500 mb-6">Kamu belum memiliki pesanan apapun. Yuk mulai belanja!</p>
                <a href="{{ route('products.index') }}"
                   class="inline-flex items-center gap-2 bg-primary hover:bg-secondary text-white px-8 py-3 rounded-full font-semibold transition-all duration-300 hover:shadow-lg hover:shadow-primary/25">
                    Mulai Belanja
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($orders as $order)
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200/60 animate-fade-in">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
                            <div>
                                <p class="text-xs text-gray-400">No. Pesanan</p>
                                <p class="font-semibold text-accent">{{ $order->order_number }}</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-xs font-semibold px-3 py-1.5 rounded-full
                                    {{ $order->payment_status === 'pending' ? 'text-amber-600 bg-amber-50' : '' }}
                                    {{ $order->payment_status === 'paid' ? 'text-green-600 bg-green-50' : '' }}
                                    {{ $order->payment_status === 'cancelled' ? 'text-red-600 bg-red-50' : '' }}">
                                    {{ $order->payment_status_label }}
                                </span>
                                <span class="text-xs text-gray-400">{{ $order->created_at->format('d M Y H:i') }}</span>
                            </div>
                        </div>

                        <div class="border-t border-gray-100 pt-4 space-y-2">
                            @foreach ($order->items as $item)
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">{{ $item->product_name }} x{{ $item->quantity }}</span>
                                    <span class="font-medium">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-t border-gray-100 mt-4 pt-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                            <div class="flex items-center gap-4 text-sm">
                                <span class="text-gray-500">Total:</span>
                                <span class="text-xl font-bold text-primary">Rp{{ number_format($order->total, 0, ',', '.') }}</span>
                                <span class="text-xs text-gray-400 bg-gray-100 px-2 py-1 rounded-full">{{ $order->payment_method_label }}</span>
                            </div>
                            @if ($order->payment_status === 'pending')
                                <a href="{{ route('orders.payment-confirmation', $order) }}"
                                   class="text-sm font-semibold text-primary hover:text-secondary transition-colors duration-200">
                                    Lihat Petunjuk Pembayaran →
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
