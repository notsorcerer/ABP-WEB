@extends('admin.layouts.app')

@section('title', 'Tambah Produk')

@section('content')
    <div class="max-w-2xl animate-fade-in">
        <div class="mb-8">
            <a href="{{ route('admin.products.index') }}" class="text-sm text-gray-500 hover:text-primary transition-colors duration-200 flex items-center gap-1 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                Kembali
            </a>
            <h1 class="text-2xl sm:text-3xl font-bold text-accent">Tambah Produk</h1>
            <p class="text-gray-500 mt-1 text-sm">Lengkapi form untuk menambahkan produk baru</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200/60 p-6 sm:p-8">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-medium text-accent mb-2">Nama Produk <span class="text-primary">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all duration-200 text-sm @error('name') border-red-300 @enderror"
                               placeholder="Nama produk">
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-medium text-accent mb-2">Kategori <span class="text-primary">*</span></label>
                        <select name="category_id" id="category_id" required
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all duration-200 text-sm @error('category_id') border-red-300 @enderror">
                            <option value="">Pilih kategori</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-accent mb-2">Harga (Rp) <span class="text-primary">*</span></label>
                        <input type="number" name="price" id="price" value="{{ old('price') }}" required min="0"
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all duration-200 text-sm @error('price') border-red-300 @enderror"
                               placeholder="150000">
                        @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-accent mb-2">Gambar Produk <span class="text-primary">*</span></label>
                        <input type="file" name="image" id="image" accept="image/*" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all duration-200 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 @error('image') border-red-300 @enderror">
                        @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        <div id="image-preview" class="mt-3 hidden">
                            <img src="" alt="Preview" class="w-32 h-32 object-cover rounded-xl border border-gray-200">
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-accent mb-2">Deskripsi <span class="text-primary">*</span></label>
                        <textarea name="description" id="description" rows="4" required
                                  class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all duration-200 text-sm @error('description') border-red-300 @enderror"
                                  placeholder="Deskripsi produk">{{ old('description') }}</textarea>
                        @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex flex-wrap gap-6">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="is_best_seller" value="1" {{ old('is_best_seller') ? 'checked' : '' }}
                                   class="w-4 h-4 rounded border-gray-300 text-primary focus:ring-primary/30">
                            <span class="text-sm text-accent">Best Seller</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="is_new_arrival" value="1" {{ old('is_new_arrival') ? 'checked' : '' }}
                                   class="w-4 h-4 rounded border-gray-300 text-primary focus:ring-primary/30">
                            <span class="text-sm text-accent">New Arrival</span>
                        </label>
                    </div>

                    <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                        <button type="submit"
                                class="bg-primary hover:bg-secondary text-white px-8 py-3 rounded-xl font-semibold transition-all duration-300 hover:shadow-lg hover:shadow-primary/25 text-sm">
                            Simpan Produk
                        </button>
                        <a href="{{ route('admin.products.index') }}"
                           class="text-sm text-gray-500 hover:text-accent transition-colors duration-200">
                            Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('image')?.addEventListener('change', function(e) {
            const preview = document.getElementById('image-preview');
            const img = preview.querySelector('img');
            const file = e.target.files[0];
            if (file) {
                preview.classList.remove('hidden');
                img.src = URL.createObjectURL(file);
            } else {
                preview.classList.add('hidden');
                img.src = '';
            }
        });
    </script>
    @endpush
@endsection
