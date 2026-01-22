@extends('layouts.app')

@section('content')
    <div class="bg-gray-50 min-h-screen py-8">
        <div class="container mx-auto px-4">

            {{-- Header --}}
            <div class="mb-8">
                <div class="flex items-center text-sm text-gray-600 mb-4">
                    <a href="{{ route('admin.adminDashboard') }}" class="hover:text-blue-600">Dashboard</a>
                    <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <a href="{{ route('admin.products.index') }}" class="hover:text-blue-600">Products</a>
                    <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-gray-800 font-semibold">Add Product</span>
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900">Add New Product</h1>
                        <p class="text-gray-600 mt-2">Create a new product listing</p>
                    </div>
                    <a href="{{ route('admin.products.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg transition font-semibold flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to List
                    </a>
                </div>
            </div>

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    {{-- Left Column - Main Info --}}
                    <div class="lg:col-span-2 space-y-6">

                        {{-- Basic Information --}}
                        <div class="bg-white rounded-xl border border-gray-200 p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Basic Information
                            </h3>

                            <div class="space-y-4">
                                {{-- Product Name --}}
                                <div>
                                    <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Product Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required
                                        placeholder="e.g., Premium Wireless Headphones"
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('nama') border-red-500 @enderror">
                                    @error('nama')
                                        <p class="text-red-500 text-sm mt-1 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- Description --}}
                                <div>
                                    <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Description <span class="text-red-500">*</span>
                                    </label>
                                    <textarea id="deskripsi" name="deskripsi" rows="5" required placeholder="Describe your product in detail..."
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Pricing & Stock --}}
                        <div class="bg-white rounded-xl border border-gray-200 p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                                Pricing & Stock
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                {{-- Price --}}
                                <div>
                                    <label for="harga" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Price (Rp) <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <span
                                            class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-semibold">Rp</span>
                                        <input type="number" id="harga" name="harga" value="{{ old('harga') }}"
                                            required min="0" step="1000" placeholder="100000"
                                            class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('harga') border-red-500 @enderror">
                                    </div>
                                    @error('harga')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Stock --}}
                                <div>
                                    <label for="stok" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Stock Quantity <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" id="stok" name="stok" value="{{ old('stok') }}"
                                        required min="0" placeholder="100"
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('stok') border-red-500 @enderror">
                                    @error('stok')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- SKU --}}
                                <div>
                                    <label for="sku" class="block text-sm font-semibold text-gray-700 mb-2">
                                        SKU Code
                                    </label>
                                    <input type="text" id="sku" name="sku" value="{{ old('sku') }}"
                                        placeholder="PRD-001"
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                </div>

                                {{-- Weight --}}
                                <div>
                                    <label for="weight" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Weight (gram)
                                    </label>
                                    <input type="number" id="weight" name="weight" value="{{ old('weight') }}"
                                        min="0" placeholder="500"
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                </div>
                            </div>
                        </div>

                        {{-- Product Images --}}
                        <div class="bg-white rounded-xl border border-gray-200 p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Product Images
                            </h3>

                            <div class="border-3 border-dashed border-gray-300 rounded-xl p-12 text-center hover:border-blue-500 transition cursor-pointer"
                                onclick="document.getElementById('gambar').click()">
                                <input type="file" id="gambar" name="gambar" accept="image/*"
                                    onchange="previewImage(event)" class="hidden">
                                <svg class="w-20 h-20 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                    </path>
                                </svg>
                                <p class="text-gray-600 font-semibold mb-2">Click to upload or drag and drop</p>
                                <p class="text-sm text-gray-500">PNG, JPG, JPEG up to 5MB</p>
                            </div>

                            {{-- Image Preview --}}
                            <div id="image-preview" class="mt-6 hidden">
                                <p class="text-sm font-semibold text-gray-700 mb-3">Preview:</p>
                                <img id="preview" class="w-full max-w-md rounded-lg shadow-lg border border-gray-200">
                            </div>

                            @error('gambar')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    {{-- Right Column - Additional Info --}}
                    <div class="lg:col-span-1 space-y-6">

                        {{-- Category --}}
                        <div class="bg-white rounded-xl border border-gray-200 p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-orange-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                    </path>
                                </svg>
                                Category
                            </h3>

                            <div>
                                <label for="kategori" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Product Category <span class="text-red-500">*</span>
                                </label>
                                <select id="kategori" name="kategori" required
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('kategori') border-red-500 @enderror">
                                    <option value="">Select Category</option>
                                    <option value="elektronik" {{ old('kategori') == 'elektronik' ? 'selected' : '' }}>
                                        Elektronik</option>
                                    <option value="fashion" {{ old('kategori') == 'fashion' ? 'selected' : '' }}>Fashion
                                    </option>
                                    <option value="makanan" {{ old('kategori') == 'makanan' ? 'selected' : '' }}>Makanan
                                    </option>
                                    <option value="peralatan" {{ old('kategori') == 'peralatan' ? 'selected' : '' }}>
                                        Peralatan</option>
                                    <option value="olahraga" {{ old('kategori') == 'olahraga' ? 'selected' : '' }}>
                                        Olahraga</option>
                                    <option value="kesehatan" {{ old('kategori') == 'kesehatan' ? 'selected' : '' }}>
                                        Kesehatan</option>
                                    <option value="lainnya" {{ old('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya
                                    </option>
                                </select>
                                @error('kategori')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="bg-white rounded-xl border border-gray-200 p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Status
                            </h3>

                            <div>
                                <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Product Status
                                </label>
                                <select id="status" name="status"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive
                                    </option>
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                </select>
                            </div>
                        </div>

                        {{-- Features --}}
                        <div class="bg-white rounded-xl border border-gray-200 p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-6">Features</h3>

                            <div class="space-y-3">
                                <label
                                    class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-blue-50 transition cursor-pointer border border-gray-200">
                                    <input type="checkbox" name="is_featured" value="1"
                                        {{ old('is_featured') ? 'checked' : '' }}
                                        class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500">
                                    <div class="ml-3">
                                        <span class="text-gray-900 font-semibold block">Featured Product</span>
                                        <span class="text-xs text-gray-500">Show on homepage</span>
                                    </div>
                                </label>

                                <label
                                    class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-blue-50 transition cursor-pointer border border-gray-200">
                                    <input type="checkbox" name="is_new" value="1"
                                        {{ old('is_new') ? 'checked' : '' }}
                                        class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500">
                                    <div class="ml-3">
                                        <span class="text-gray-900 font-semibold block">New Arrival</span>
                                        <span class="text-xs text-gray-500">Mark as new</span>
                                    </div>
                                </label>

                                <label
                                    class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-blue-50 transition cursor-pointer border border-gray-200">
                                    <input type="checkbox" name="is_bestseller" value="1"
                                        {{ old('is_bestseller') ? 'checked' : '' }}
                                        class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500">
                                    <div class="ml-3">
                                        <span class="text-gray-900 font-semibold block">Best Seller</span>
                                        <span class="text-xs text-gray-500">Popular item</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="bg-linear-to-br from-blue-50 to-purple-50 rounded-xl border border-blue-200 p-6">
                            <div class="space-y-3">
                                <button type="submit"
                                    class="w-full bg-linear-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-6 py-4 rounded-lg transition font-bold shadow-lg transform hover:scale-105 flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Create Product
                                </button>

                                <a href="{{ route('admin.products.index') }}"
                                    class="block w-full bg-white hover:bg-gray-50 text-gray-700 border-2 border-gray-300 px-6 py-4 rounded-lg transition font-bold text-center">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const previewDiv = document.getElementById('image-preview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewDiv.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
