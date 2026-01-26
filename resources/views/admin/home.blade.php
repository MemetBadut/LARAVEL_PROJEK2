@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <!-- Hero Section -->
        <div class="bg-linear-to-r from-blue-500 to-purple-600 text-white rounded-lg shadow-xl p-12 mb-8">
            <h1 class="text-5xl font-bold mb-4">Selamat Datang {{ $nama }}</h1>
            <p class="text-xl mb-6">Temukan produk berkualitas dengan harga terbaik</p>
            <a href="{{ route('products.index') }}"
                class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                Cek Produk
            </a>
        </div>

        <!-- Featured Products -->
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Tombol Navigasi</h2>
        <div>
            {{-- Tombol Navigasi --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                {{-- Cek Produk --}}
                <a href="{{ route('products.index') }}"
                    class="group bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:-translate-y-2">
                    <div class="p-6">
                        <div
                            class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Cek Produk</h3>
                        <p class="text-gray-600 text-sm">Lihat semua produk yang tersedia</p>
                    </div>
                    <div class="h-1 bg-linear-to-r from-blue-500 to-blue-600"></div>
                </a>

                {{-- Dashboard --}}
                <a href="{{ route('admin.adminDashboard') }}"
                    class="group bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:-translate-y-2">
                    <div class="p-6">
                        <div
                            class="w-14 h-14 bg-purple-100 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Dashboard</h3>
                        <p class="text-gray-600 text-sm">Kelola dan monitoring toko</p>
                    </div>
                    <div class="h-1 bg-linear-to-r from-purple-500 to-purple-600"></div>
                </a>

                {{-- Tambah Produk --}}
                <a href="{{ route('admin.products.create') }}"
                    class="group bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:-translate-y-2">
                    <div class="p-6">
                        <div
                            class="w-14 h-14 bg-green-100 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Tambah Produk</h3>
                        <p class="text-gray-600 text-sm">Buat produk baru ke katalog</p>
                    </div>
                    <div class="h-1 bg-linear-to-r from-green-500 to-green-600"></div>
                </a>

                {{-- Tambah Kategori --}}
                <a href="{{ route('admin.products.create') }}"
                    class="group bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:-translate-y-2">
                    <div class="p-6">
                        <div
                            class="w-14 h-14 bg-orange-100 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Tambah Kategori</h3>
                        <p class="text-gray-600 text-sm">Buat kategori produk baru</p>
                    </div>
                    <div class="h-1 bg-linear-to-r from-orange-500 to-orange-600"></div>
                </a>

            </div>
        </div>
    </div>
@endsection
