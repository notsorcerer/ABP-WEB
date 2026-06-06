@extends('layouts.app')

@section('title', 'Konfirmasi Pembayaran')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8 text-center animate-fade-in">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-accent">Pesanan Dibuat!</h1>
            <p class="text-gray-500 mt-1">Terima kasih, pesanan kamu telah berhasil dibuat.</p>
        </div>

        <div class="grid md:grid-cols-5 gap-6">
            <div class="md:col-span-3 space-y-6">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200/60 animate-fade-in">
                    <h2 class="text-lg font-bold text-accent mb-4">Detail Pesanan</h2>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">No. Pesanan</span>
                            <span class="font-semibold text-accent">{{ $order->order_number }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Tanggal</span>
                            <span class="font-semibold text-accent">{{ $order->created_at->format('d M Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Status</span>
                            <span class="text-xs font-semibold text-amber-600 bg-amber-50 px-2.5 py-1 rounded-full">{{ $order->payment_status_label }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Pembayaran</span>
                            <span class="font-semibold text-accent">{{ $order->payment_method_label }}</span>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 mt-4 pt-4 space-y-3">
                        @foreach ($order->items as $item)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 truncate mr-2">{{ $item->product_name }} x{{ $item->quantity }}</span>
                                <span class="font-medium">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-gray-100 mt-4 pt-4 flex justify-between items-center">
                        <span class="font-semibold text-accent">Total</span>
                        <span class="text-xl font-bold text-primary">Rp{{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200/60 animate-fade-in">
                    <h2 class="text-lg font-bold text-accent mb-4">Alamat Pengiriman</h2>
                    <div class="text-sm text-gray-600 space-y-1">
                        <p class="font-semibold text-accent">{{ $order->shipping_name }}</p>
                        <p>{{ $order->shipping_address }}</p>
                        <p>{{ $order->shipping_district }}, {{ $order->shipping_city }}</p>
                        <p>{{ $order->shipping_province }} - {{ $order->shipping_postal_code }}</p>
                        <p>{{ $order->shipping_country }}</p>
                        <p class="mt-2">Telp: {{ $order->shipping_phone }}</p>
                        <p>Email: {{ $order->shipping_email }}</p>
                        @if ($order->shipping_latitude && $order->shipping_longitude)
                            <div class="mt-3 rounded-xl overflow-hidden border border-gray-200 h-36">
                                <iframe src="https://www.google.com/maps?q={{ $order->shipping_latitude }},{{ $order->shipping_longitude }}&z=15&output=embed"
                                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                            <a href="https://www.google.com/maps?q={{ $order->shipping_latitude }},{{ $order->shipping_longitude }}"
                               target="_blank" rel="noopener noreferrer"
                               class="text-xs text-primary hover:text-secondary font-semibold mt-1 inline-flex items-center gap-1 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                                Buka di Google Maps
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="md:col-span-2 space-y-6">
                @if ($order->payment_method === 'bank_transfer')
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200/60 animate-fade-in animate-delay-200">
                        <h2 class="text-lg font-bold text-accent mb-4">Pembayaran Transfer Bank</h2>
                        <div class="space-y-3">
                            @foreach ($paymentDetails['banks'] as $bank)
                                <div class="p-4 rounded-xl border-2 border-gray-200">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-bold text-accent text-base">{{ $bank['name'] }}</span>
                                        <button onclick="copyToClipboard('{{ $bank['number'] }}')"
                                                class="text-xs text-primary hover:text-secondary transition-colors duration-200 font-semibold">
                                            Salin
                                        </button>
                                    </div>
                                    <p class="text-lg font-mono font-bold text-primary tracking-wider">{{ $bank['number'] }}</p>
                                    <p class="text-xs text-gray-500 mt-1">a/n {{ $bank['holder'] }}</p>
                                </div>
                            @endforeach
                        </div>
                        <p class="text-xs text-gray-500 mt-4 text-center">{{ $paymentDetails['note'] }}</p>
                    </div>
                @elseif ($order->payment_method === 'ewallet')
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200/60 animate-fade-in animate-delay-200">
                        <h2 class="text-lg font-bold text-accent mb-4">Pembayaran E-Wallet</h2>
                        <div class="space-y-3">
                            @foreach ($paymentDetails['providers'] as $provider)
                                <div class="p-4 rounded-xl border-2 border-gray-200">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-bold text-accent text-base">{{ $provider['name'] }}</span>
                                        <button onclick="copyToClipboard('{{ $provider['number'] }}')"
                                                class="text-xs text-primary hover:text-secondary transition-colors duration-200 font-semibold">
                                            Salin
                                        </button>
                                    </div>
                                    <p class="text-lg font-mono font-bold text-primary tracking-wider">{{ $provider['number'] }}</p>
                                    <p class="text-xs text-gray-500 mt-1">a/n {{ $provider['holder'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @elseif ($order->payment_method === 'qr_code')
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200/60 animate-fade-in animate-delay-200 text-center">
                        <h2 class="text-lg font-bold text-accent mb-4">Pembayaran QRIS</h2>
                        <div class="bg-gray-50 rounded-xl p-4 inline-block">
                            <img src="{{ $paymentDetails['image'] }}" alt="QRIS LiquidPedia"
                                 class="w-48 h-48 mx-auto object-contain">
                        </div>
                        <p class="text-xs text-gray-500 mt-4">{{ $paymentDetails['note'] }}</p>
                    </div>
                @elseif ($order->payment_method === 'cod')
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200/60 animate-fade-in animate-delay-200">
                        <h2 class="text-lg font-bold text-accent mb-4">COD (Bayar di Tempat)</h2>
                        <div class="p-4 rounded-xl bg-gray-50">
                            <p class="text-sm text-gray-600 text-center">{{ $paymentDetails['note'] }}</p>
                        </div>
                    </div>
                @endif

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200/60 animate-fade-in animate-delay-300">
                    <p class="text-sm text-gray-600 text-center mb-4">
                        Sudah melakukan pembayaran? Konfirmasi ke WhatsApp kami.
                    </p>
                    @php
                        $waMessage = "Konfirmasi Pembayaran\nNo. Pesanan: {$order->order_number}\nTotal: Rp" . number_format($order->total, 0, ',', '.') . "\n\nSaya sudah melakukan pembayaran.";
                        $waUrl = "https://wa.me/6282191488380?text=" . urlencode($waMessage);
                    @endphp
                    <a href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer"
                       class="flex items-center justify-center gap-2 w-full bg-green-500 hover:bg-green-600 text-white py-3.5 px-8 rounded-xl font-semibold transition-all duration-300 hover:shadow-lg text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Konfirmasi Pesanan via WhatsApp
                    </a>
                </div>
            </div>
        </div>

        <div class="text-center mt-8 animate-fade-in">
            <a href="{{ route('home') }}"
               class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-primary transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            const btn = event.target;
            const original = btn.textContent;
            btn.textContent = 'Tersalin!';
            setTimeout(() => btn.textContent = original, 2000);
        });
    }
</script>
@endpush
