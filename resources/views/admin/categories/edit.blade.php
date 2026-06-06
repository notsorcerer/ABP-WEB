@extends('admin.layouts.app')

@section('title', 'Edit Kategori')

@section('content')
    <div class="max-w-lg animate-fade-in">
        <div class="mb-8">
            <a href="{{ route('admin.categories.index') }}" class="text-sm text-gray-500 hover:text-primary transition-colors duration-200 flex items-center gap-1 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                Kembali
            </a>
            <h1 class="text-2xl sm:text-3xl font-bold text-accent">Edit Kategori</h1>
            <p class="text-gray-500 mt-1 text-sm">Perbarui nama kategori</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200/60 p-6 sm:p-8">
            <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-medium text-accent mb-2">Nama Kategori <span class="text-primary">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all duration-200 text-sm @error('name') border-red-300 @enderror"
                               placeholder="Nama kategori" autofocus>
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                        <button type="submit"
                                class="bg-primary hover:bg-secondary text-white px-8 py-3 rounded-xl font-semibold transition-all duration-300 hover:shadow-lg hover:shadow-primary/25 text-sm">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.categories.index') }}"
                           class="text-sm text-gray-500 hover:text-accent transition-colors duration-200">
                            Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
