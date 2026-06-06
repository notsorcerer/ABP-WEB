@extends('admin.layouts.app')

@section('title', 'Produk')

@section('content')
    <div class="animate-fade-in">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-accent">Produk</h1>
                <p class="text-gray-500 mt-1 text-sm">Kelola semua produk LiquidPedia</p>
            </div>
            <a href="{{ route('admin.products.create') }}"
               class="inline-flex items-center gap-2 bg-primary hover:bg-secondary text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 hover:shadow-lg hover:shadow-primary/25 w-fit">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Produk
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200/60 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200/60">
                            <th class="text-left px-6 py-4 font-semibold text-accent">Produk</th>
                            <th class="text-left px-6 py-4 font-semibold text-accent hidden sm:table-cell">Kategori</th>
                            <th class="text-left px-6 py-4 font-semibold text-accent hidden md:table-cell">Harga</th>
                            <th class="text-left px-6 py-4 font-semibold text-accent hidden lg:table-cell">Status</th>
                            <th class="text-right px-6 py-4 font-semibold text-accent">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($products as $product)
                            <tr class="hover:bg-gray-50/50 transition-colors duration-200">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-xl overflow-hidden bg-gray-100 shrink-0">
                                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                                 class="w-full h-full object-cover"
                                                 loading="lazy"
                                                 onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2248%22 height=%2248%22><rect fill=%22%23f3f4f6%22 width=%2248%22 height=%2248%22/><text x=%2224%22 y=%2224%22 text-anchor=%22middle%22 dy=%22.3em%22 font-size=%2220%22>📦</text></svg>'">
                                        </div>
                                        <div class="min-w-0">
                                            <p class="font-medium text-accent truncate max-w-[200px]">{{ $product->name }}</p>
                                            <p class="text-xs text-gray-400 mt-0.5">ID: #{{ $product->id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 hidden sm:table-cell">
                                    <span class="text-xs font-semibold text-primary bg-primary/10 px-2.5 py-1.5 rounded-full">
                                        {{ $product->category->name ?? $product->category }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 hidden md:table-cell">
                                    <span class="font-semibold text-accent">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-6 py-4 hidden lg:table-cell">
                                    <div class="flex gap-1.5">
                                        @if ($product->is_best_seller)
                                            <span class="text-[10px] font-semibold text-amber-600 bg-amber-50 px-2 py-1 rounded-full">Best</span>
                                        @endif
                                        @if ($product->is_new_arrival)
                                            <span class="text-[10px] font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-full">Baru</span>
                                        @endif
                                        @if (!$product->is_best_seller && !$product->is_new_arrival)
                                            <span class="text-[10px] text-gray-400">-</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.products.edit', $product) }}"
                                           class="p-2 text-gray-400 hover:text-primary hover:bg-primary/10 rounded-lg transition-all duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" data-confirm="Yakin ingin menghapus produk {{ $product->name }}?"
                                                    class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <div class="text-4xl mb-3">📦</div>
                                    <p class="text-gray-500 font-medium">Belum ada produk</p>
                                    <p class="text-gray-400 text-xs mt-1">Tambahkan produk pertama kamu</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
