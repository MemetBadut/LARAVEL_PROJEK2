@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Edit Produk</h2>

            <form action="{{ route('admin.products.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="nama" class="block text-gray-700 font-semibold mb-2">Nama Produk</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama', $produk->nama_produk) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nama') border-red-500 @enderror">
                    @error('nama')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="harga" class="block text-gray-700 font-semibold mb-2">Harga</label>
                    <input type="number" id="harga" name="harga" value="{{ old('harga', $produk->harga_produk) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('harga') border-red-500 @enderror">
                    @error('harga')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="stok" class="block text-gray-700 font-semibold mb-2">Stok</label>
                    <input type="number" id="stok" name="stok" value="{{ old('stok', $produk->stok_produk) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('stok') border-red-500 @enderror">
                    @error('stok')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $produk->deskripsi_produk) }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="gambar" class="block text-gray-700 font-semibold mb-2">Gambar Produk</label>
                    @if ($produk->gambar)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $produk->gambar) }}" alt="Gambar Produk"
                                class="w-40 h-40 object-cover rounded-lg shadow">
                        </div>
                    @endif
                    <input type="file" id="gambar" name="gambar"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('gambar') border-red-500 @enderror">
                    @error('gambar')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex space-x-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                        Update
                    </button>
                    <a href="{{ route('admin.products.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
