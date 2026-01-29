@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <!-- Hero Section -->
        <div class="bg-linear-to-r from-blue-500 to-purple-600 text-white rounded-lg shadow-xl p-12 mb-8">
            <h1 class="text-5xl font-bold mb-4">Selamat Datang di Toko Soto Pak Memet</h1>
            <p class="text-xl mb-6">Temukan produk berkualitas dengan harga terbaik</p>
            <a href="{{ route('products.index') }}"
                class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                Belanja Sekarang
            </a>
        </div>

        <!-- Featured Products -->
        {{-- Modern Section Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-1">Produk Unggulan</h2>
                <p class="text-gray-500 text-sm">Temukan produk terbaik pilihan kami</p>
            </div>
            <a href="{{ route('products.index') }}"
                class="group inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg">
                <span>Lihat Semua</span>
                <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                    </path>
                </svg>
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($produks as $produk)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                    @if ($produk->gambar)
                        <img src="{{ asset('storage/' . $produk->gambar) }}" class="w-full h-48 object-cover"
                            alt="{{ $produk->nama }}">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400">No Image</span>
                        </div>
                    @endif
                    <div class="p-4">
                        <h5 class="text-lg font-bold text-gray-800 mb-2">{{ $produk->nama_produk }}</h5>
                        <p class="text-2xl font-bold text-blue-600 mb-4">Rp
                            {{ number_format($produk->harga_produk, 0, ',', '.') }}</p>
                        <a href="{{ route('products.show', ['produk' => $produk->slug]) }}"
                            class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center px-4 py-2 rounded-lg transition">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
