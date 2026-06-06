@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-accent">Checkout</h1>
            <p class="text-gray-500 mt-1">Lengkapi data pengiriman dan pilih metode pembayaran</p>
        </div>

        <form method="POST" action="{{ route('checkout.process') }}">
            @csrf
            <div class="grid lg:grid-cols-5 gap-8">
                <div class="lg:col-span-3 space-y-6 animate-fade-in">
                    <div class="bg-white rounded-2xl p-6 shadow-sm">
                        <h2 class="text-lg font-bold text-accent mb-5">Data Pengiriman</h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="sm:col-span-2">
                                <label for="name" class="block text-sm font-medium text-accent mb-1.5">Nama Lengkap</label>
                                <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name ?? '') }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary focus:outline-none transition-colors duration-200 text-sm @error('name') border-red-400 @enderror"
                                       placeholder="Nama penerima" required>
                                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="country" class="block text-sm font-medium text-accent mb-1.5">Negara</label>
                                <input type="text" name="country" id="country" value="{{ old('country', 'Indonesia') }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary focus:outline-none transition-colors duration-200 text-sm @error('country') border-red-400 @enderror"
                                       readonly>
                            </div>

                            <div>
                                <label for="province" class="block text-sm font-medium text-accent mb-1.5">Provinsi</label>
                                <input type="text" name="province" id="province" value="{{ old('province') }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary focus:outline-none transition-colors duration-200 text-sm @error('province') border-red-400 @enderror"
                                       placeholder="Provinsi" required>
                                @error('province') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="city" class="block text-sm font-medium text-accent mb-1.5">Kota / Kabupaten</label>
                                <input type="text" name="city" id="city" value="{{ old('city') }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary focus:outline-none transition-colors duration-200 text-sm @error('city') border-red-400 @enderror"
                                       placeholder="Kota" required>
                                @error('city') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="district" class="block text-sm font-medium text-accent mb-1.5">Kecamatan</label>
                                <input type="text" name="district" id="district" value="{{ old('district') }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary focus:outline-none transition-colors duration-200 text-sm @error('district') border-red-400 @enderror"
                                       placeholder="Kecamatan" required>
                                @error('district') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="zipcode" class="block text-sm font-medium text-accent mb-1.5">Kode Pos</label>
                                <input type="text" name="zipcode" id="zipcode" value="{{ old('zipcode') }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary focus:outline-none transition-colors duration-200 text-sm @error('zipcode') border-red-400 @enderror"
                                       placeholder="Kode pos" required>
                                @error('zipcode') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="sm:col-span-2">
                                <label for="address" class="block text-sm font-medium text-accent mb-1.5">Alamat Lengkap</label>
                                <textarea name="address" id="address" rows="3"
                                          class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary focus:outline-none transition-colors duration-200 text-sm @error('address') border-red-400 @enderror"
                                          placeholder="Nama jalan, nomor rumah, gedung, patokan" required>{{ old('address') }}</textarea>
                                @error('address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <x-location-picker />

                            <div>
                                <label for="phone" class="block text-sm font-medium text-accent mb-1.5">No. Telepon</label>
                                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary focus:outline-none transition-colors duration-200 text-sm @error('phone') border-red-400 @enderror"
                                       placeholder="08xxxxxxxxxx" required>
                                @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-accent mb-1.5">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email ?? '') }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary focus:outline-none transition-colors duration-200 text-sm @error('email') border-red-400 @enderror"
                                       placeholder="email@example.com" required>
                                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2 animate-fade-in animate-delay-200">
                    <div class="bg-white rounded-2xl p-6 shadow-sm sticky top-24 space-y-6">
                        <h2 class="text-lg font-bold text-accent">Ringkasan Pesanan</h2>

                        <div class="space-y-3 text-sm">
                            @foreach ($products as $product)
                                <div class="flex justify-between text-gray-600">
                                    <span class="truncate mr-2">{{ $product->name }} x{{ $product->quantity }}</span>
                                    <span class="font-medium">Rp{{ number_format($product->subtotal, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-t border-gray-200 pt-4">
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-accent">Total</span>
                                <span class="text-xl font-bold text-primary">Rp{{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-5">
                            <h3 class="text-sm font-semibold text-accent mb-3">Metode Pembayaran</h3>
                            <div class="space-y-3">
                                <label class="flex items-center gap-3 p-4 rounded-xl border-2 border-gray-200 cursor-pointer transition-all duration-200 has-[:checked]:border-primary has-[:checked]:bg-primary/5">
                                    <input type="radio" name="payment_method" value="bank_transfer" checked
                                           class="text-primary focus:ring-primary">
                                    <div>
                                        <span class="font-medium text-accent text-sm">Transfer Bank</span>
                                        <p class="text-xs text-gray-500 mt-0.5">BCA / Mandiri / BRI / BNI</p>
                                    </div>
                                </label>
                                <label class="flex items-center gap-3 p-4 rounded-xl border-2 border-gray-200 cursor-pointer transition-all duration-200 has-[:checked]:border-primary has-[:checked]:bg-primary/5">
                                    <input type="radio" name="payment_method" value="ewallet"
                                           class="text-primary focus:ring-primary">
                                    <div>
                                        <span class="font-medium text-accent text-sm">E-Wallet</span>
                                        <p class="text-xs text-gray-500 mt-0.5">GoPay / OVO / Dana</p>
                                    </div>
                                </label>
                                <label class="flex items-center gap-3 p-4 rounded-xl border-2 border-gray-200 cursor-pointer transition-all duration-200 has-[:checked]:border-primary has-[:checked]:bg-primary/5">
                                    <input type="radio" name="payment_method" value="qr_code"
                                           class="text-primary focus:ring-primary">
                                    <div>
                                        <span class="font-medium text-accent text-sm">QR Code (QRIS)</span>
                                        <p class="text-xs text-gray-500 mt-0.5">Scan QRIS via e-wallet atau mobile banking</p>
                                    </div>
                                </label>
                                <label class="flex items-center gap-3 p-4 rounded-xl border-2 border-gray-200 cursor-pointer transition-all duration-200 has-[:checked]:border-primary has-[:checked]:bg-primary/5">
                                    <input type="radio" name="payment_method" value="cod"
                                           class="text-primary focus:ring-primary">
                                    <div>
                                        <span class="font-medium text-accent text-sm">COD (Bayar di Tempat)</span>
                                        <p class="text-xs text-gray-500 mt-0.5">Bayar saat barang diterima</p>
                                    </div>
                                </label>
                            </div>
                            @error('payment_method') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit"
                                class="w-full bg-primary hover:bg-secondary text-white py-3.5 px-8 rounded-xl font-semibold transition-all duration-300 hover:shadow-lg hover:shadow-primary/25 flex items-center justify-center gap-2 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            Buat Pesanan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection


