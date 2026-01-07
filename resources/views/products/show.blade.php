@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white rounded-lg shadow-md p-6">
        {{-- <div>
            @if ($produk->gambar)
                <img src="{{ asset('storage/' . $produk->gambar) }}" class="w-full rounded-lg shadow-lg"
                    alt="{{ $produk->nama }}">
            @else
                <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                    <span class="text-gray-400 text-xl">No Image</span>
                </div>
            @endif
        </div> --}}

        <div>
            <h2 class="text-4xl font-bold text-gray-800 mb-4">{{ $produk->nama_produk }}</h2>
            <h3 class="text-3xl font-bold text-blue-600 mb-6">Rp {{ number_format($produk->harga_produk, 0, ',', '.') }}</h3>

            <p class="text-gray-600 mb-6 leading-relaxed">{{ $produk->deskripsi_produk }}</p>

            <!-- Status Produk -->
            <div class="mb-6 p-4 rounded-lg
                @if($produk->stok_produk > 10) bg-green-50 border-2 border-green-200
                @elseif($produk->stok_produk > 0 && $produk->stok_produk <= 10) bg-yellow-50 border-2 border-yellow-200
                @else bg-red-50 border-2 border-red-200 @endif">

                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <!-- Icon Status -->
                        @if($produk->stok_produk > 10)
                            <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <strong class="text-green-800 text-lg block">Tersedia</strong>
                                <span class="text-green-600 text-sm">Stok: {{ $produk->stok_produk }} pcs</span>
                            </div>
                        @elseif($produk->stok_produk > 0 && $produk->stok_produk <= 10)
                            <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                            </div>
                            <div>
                                <strong class="text-yellow-800 text-lg block">Stok Terbatas</strong>
                                <span class="text-yellow-600 text-sm">Hanya tersisa {{ $produk->stok_produk }} pcs</span>
                            </div>
                        @else
                            <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                            <div>
                                <strong class="text-red-800 text-lg block">Stok Habis</strong>
                                <span class="text-red-600 text-sm">Produk tidak tersedia</span>
                            </div>
                        @endif
                    </div>

                    <!-- Badge Status -->
                    @if($produk->stok_produk > 10)
                        <span class="px-4 py-2 bg-green-500 text-white rounded-full text-sm font-bold">
                            ✓ Ready Stock
                        </span>
                    @elseif($produk->stok_produk > 0 && $produk->stok_produk <= 10)
                        <span class="px-4 py-2 bg-yellow-500 text-white rounded-full text-sm font-bold animate-pulse">
                            ⚠ Limited
                        </span>
                    @else
                        <span class="px-4 py-2 bg-red-500 text-white rounded-full text-sm font-bold">
                            ✕ Out of Stock
                        </span>
                    @endif
                </div>

                <!-- Progress Bar (untuk stok terbatas) -->
                @if($produk->stok_produk > 0 && $produk->stok_produk <= 10)
                <div class="mt-3">
                    <div class="w-full bg-yellow-200 rounded-full h-2">
                        <div class="bg-yellow-500 h-2 rounded-full transition-all" style="width: {{ ($produk->stok_produk / 10) * 100 }}%"></div>
                    </div>
                    <p class="text-yellow-700 text-xs mt-1 font-semibold">🔥 Buruan! Stok hampir habis</p>
                </div>
                @endif
            </div>

            <!-- Form Pembelian -->
            <form action="{{ route('cart.add', $produk->id) }}" method="POST">
                @csrf
                @if($produk->stok_produk > 0)
                <div class="mb-6">
                    <label for="quantity" class="block text-gray-700 font-semibold mb-2">Jumlah</label>
                    <div class="flex items-center space-x-4">
                        <button type="button" onclick="decreaseQty()" class="w-10 h-10 bg-gray-200 hover:bg-gray-300 rounded-lg font-bold text-gray-700 transition">
                            -
                        </button>
                        <input type="hidden" name="page" value="{{ request('page') }}">
                        <input type="number" id="quantity" name="quantity" value="1" min="1"
                            max="{{ $produk->stok_produk }}"
                            class="w-24 px-4 py-2 border-2 border-gray-300 rounded-lg text-center font-bold text-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <button type="button" onclick="increaseQty()" class="w-10 h-10 bg-gray-200 hover:bg-gray-300 rounded-lg font-bold text-gray-700 transition">
                            +
                        </button>
                        <span class="text-gray-600 text-sm">Maks: {{ $produk->stok_produk }}</span>
                    </div>
                </div>

                <div class="flex space-x-4">
                    <button type="submit"
                        class="flex-1 bg-linear-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white px-8 py-3 rounded-lg transition font-semibold shadow-lg transform hover:scale-105 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Tambah ke Keranjang
                    </button>
                    <button type="button"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition font-semibold shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </button>
                </div>
                @else
                <!-- Out of Stock - Notify Me -->
                <div class="space-y-4">
                    <button type="button"
                        class="w-full bg-gray-400 text-white px-8 py-3 rounded-lg font-semibold cursor-not-allowed" disabled>
                        Stok Habis
                    </button>
                    <button type="button"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg transition font-semibold flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        Beritahu Saya Ketika Tersedia
                    </button>
                </div>
                @endif
            </form>

            <!-- Additional Info -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div class="flex items-center space-x-2 text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                        </svg>
                        <span>Gratis Ongkir</span>
                    </div>
                    <div class="flex items-center space-x-2 text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        <span>Garansi 100%</span>
                    </div>
                    <div class="flex items-center space-x-2 text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Pengiriman Cepat</span>
                    </div>
                    <div class="flex items-center space-x-2 text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        <span>Pembayaran Aman</span>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="mt-6">
                <a href="{{ route('products.index') }}"
                    class="inline-flex items-center text-gray-600 hover:text-gray-800 font-semibold">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Produk
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    function increaseQty() {
        const input = document.getElementById('quantity');
        const max = parseInt(input.max);
        const current = parseInt(input.value);
        if (current < max) {
            input.value = current + 1;
        }
    }

    function decreaseQty() {
        const input = document.getElementById('quantity');
        const min = parseInt(input.min);
        const current = parseInt(input.value);
        if (current > min) {
            input.value = current - 1;
        }
    }
</script>
@endsection
