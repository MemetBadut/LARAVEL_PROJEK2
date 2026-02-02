@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-linear-to-br from-gray-50 to-gray-100 py-12 px-4">
        <div class="max-w-3xl mx-auto">
            {{-- Header --}}
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-2">
                    <a href="{{ route('admin.products.index') }}" class="text-gray-400 hover:text-gray-600 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <h2 class="text-3xl font-bold text-gray-900">Edit Produk</h2>
                </div>
                <p class="text-gray-600 ml-9">Perbarui informasi produk Anda</p>
            </div>

            {{-- Form Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <form action="{{ route('admin.products.update', $produk->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="p-8 space-y-6">
                        {{-- Upload Gambar Section --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Gambar Produk</label>

                            <div class="relative">
                                {{-- Preview Image --}}
                                <div class="flex items-start gap-6">
                                    {{-- Current Image Preview --}}
                                    @if ($produk->gambar)
                                        <div class="relative group">
                                            <img src="{{ asset('storage/' . $produk->gambar) }}" alt="Current Image"
                                                id="current-image"
                                                class="w-32 h-32 object-cover rounded-xl border-2 border-gray-200 shadow-sm">
                                            <div
                                                class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100
                                                        rounded-xl transition-opacity flex items-center justify-center">
                                                <span class="text-white text-xs font-medium">Gambar Saat Ini</span>
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Upload Area --}}
                                    <div class="flex-1">
                                        <label for="gambar"
                                            class="relative flex flex-col items-center justify-center w-full h-32
                                                      border-2 border-dashed border-gray-300 rounded-xl cursor-pointer
                                                      bg-gray-50 hover:bg-gray-100 transition-all group">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <svg class="w-10 h-10 mb-2 text-gray-400 group-hover:text-gray-500 transition"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                </svg>
                                                <p class="mb-1 text-sm text-gray-600 font-medium">
                                                    <span class="text-blue-600">Klik untuk upload</span> atau drag & drop
                                                </p>
                                                <p class="text-xs text-gray-500">PNG, JPG, JPEG (MAX. 2MB)</p>
                                            </div>
                                            <input id="gambar" name="gambar" type="file" class="hidden"
                                                accept="image/*" onchange="previewNewImage(event)">
                                        </label>

                                        {{-- New Image Preview --}}
                                        <div id="new-image-preview" class="hidden mt-3">
                                            <div class="relative inline-block">
                                                <img id="preview-img" src=""
                                                    class="w-32 h-32 object-cover rounded-xl border-2 border-blue-500 shadow-sm">
                                                <button type="button" onclick="removeNewImage()"
                                                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1
                                                               hover:bg-red-600 transition shadow-md">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @error('gambar')
                                <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Nama Produk --}}
                        <div>
                            <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Produk
                            </label>
                            <input type="text" id="nama" name="nama"
                                value="{{ old('nama', $produk->nama_produk) }}" required placeholder="Masukkan nama produk"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl
                                          focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                          transition-all @error('nama') border-red-500 @enderror">
                            @error('nama')
                                <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Harga --}}
                        <div>
                            <label for="harga" class="block text-sm font-semibold text-gray-700 mb-2">
                                Harga Produk
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-medium">
                                    Rp
                                </span>
                                <input type="number" id="harga" name="harga"
                                    value="{{ old('harga', $produk->harga_produk) }}" required placeholder="0"
                                    class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl
                                              focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                              transition-all @error('harga') border-red-500 @enderror">
                            </div>
                            @error('harga')
                                <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Stok --}}
                        <div>
                            <label for="stok" class="block text-sm font-semibold text-gray-700 mb-2">
                                Stok Produk
                            </label>
                            <input type="number" id="stok" name="stok"
                                value="{{ old('stok', $produk->stok_produk) }}" required placeholder="0"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl
                                          focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                          transition-all @error('stok') border-red-500 @enderror">
                            @error('stok')
                                <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div>
                            <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">
                                Deskripsi Produk
                            </label>
                            <textarea id="deskripsi" name="deskripsi" rows="5" placeholder="Tulis deskripsi produk..."
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl
                                             focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                             transition-all resize-none @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $produk->deskripsi_produk) }}</textarea>
                            @error('deskripsi')
                                <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="bg-gray-50 px-8 py-6 border-t border-gray-200 flex items-center justify-between gap-4">
                        <a href="{{ route('admin.products.index') }}"
                            class="px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 font-medium
                                  rounded-xl hover:bg-gray-50 transition-all flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                            Batal
                        </a>

                        <form action="{{ route('admin.products.update', $produk->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                class="px-8 py-3 bg-linear-to-r from-blue-600 to-blue-700
                                       hover:from-blue-700 hover:to-blue-800 text-white font-medium
                                       rounded-xl transition-all shadow-md hover:shadow-lg
                                       flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Update Produk
                            </button>
                        </form>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- JavaScript untuk Preview Image --}}
    <script>
        function previewNewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-img').src = e.target.result;
                    document.getElementById('new-image-preview').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }

        function removeNewImage() {
            document.getElementById('gambar').value = '';
            document.getElementById('new-image-preview').classList.add('hidden');
            document.getElementById('preview-img').src = '';
        }
    </script>
@endsection
