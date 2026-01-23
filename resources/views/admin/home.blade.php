@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <!-- Hero Section -->
        <div class="bg-linear-to-r from-blue-500 to-purple-600 text-white rounded-lg shadow-xl p-12 mb-8">
            <h1 class="text-5xl font-bold mb-4">Selamat Datang {{  }}</h1>
            <p class="text-xl mb-6">Temukan produk berkualitas dengan harga terbaik</p>
            <a href="{{ route('products.index') }}"
                class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                Belanja Sekarang
            </a>
        </div>

        <!-- Featured Products -->
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Create Navigation</h2>

    </div>
@endsection
