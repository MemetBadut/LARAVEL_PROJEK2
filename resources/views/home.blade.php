@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <!-- Hero Section -->
        <div class="bg-linear-to-r from-blue-500 to-purple-600 text-white rounded-lg shadow-xl p-12 mb-8">
            <h1 class="text-5xl font-bold mb-4">Selamat Datang di Toko Kami!</h1>
            <p class="text-xl mb-6">Temukan produk berkualitas dengan harga terbaik</p>
            <a href="{{ route('products.index') }}"
                class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                Belanja Sekarang
            </a>
        </div>

        <!-- Featured Products -->
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Produk Unggulan</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            {{-- @foreach ($featuredProducts as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                    @if ($product->gambar)
                        <img src="{{ asset('storage/' . $product->gambar) }}" class="w-full h-48 object-cover"
                            alt="{{ $product->nama }}">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400">No Image</span>
                        </div>
                    @endif
                    <div class="p-4">
                        <h5 class="text-lg font-bold text-gray-800 mb-2">{{ $product->nama }}</h5>
                        <p class="text-2xl font-bold text-blue-600 mb-4">Rp
                            {{ number_format($product->harga, 0, ',', '.') }}</p>
                        <a href="{{ route('products.show', $product->id) }}"
                            class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center px-4 py-2 rounded-lg transition">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach --}}
        </div>
    </div>
@endsection
