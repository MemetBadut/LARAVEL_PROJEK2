@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-linear-to-br from-gray-50 to-gray-100 py-8">
        <div class="container mx-auto px-4">
            {{-- Search & Filter Bar --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-8">
                <form action="{{ route('products.index') }}" method="GET">
                    {{-- Search Row --}}
                    <div class="flex flex-col lg:flex-row gap-4 mb-4">
                        {{-- Search Input --}}
                        <div class="flex-1">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Cari produk berdasarkan nama..."
                                    class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            </div>
                        </div>

                        {{-- Category Filter --}}
                        <div class="lg:w-64">
                            <select name="category" onchange="this.form.submit()"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition appearance-none cursor-pointer bg-white">
                                <option value="">Semua Kategori</option>
                                @foreach ($categories ?? [] as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Sort Filter --}}
                        <div class="lg:w-64">
                            <select name="sortlist" onchange="this.form.submit()"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition appearance-none cursor-pointer bg-white">
                                <option value="">Urutkan</option>
                                <option value="newest" {{ request('sortlist') == 'newest' ? 'selected' : '' }}>Terbaru
                                </option>
                                <option value="price_low" {{ request('sortlist') == 'price_low' ? 'selected' : '' }}>Harga
                                    Terendah</option>
                                <option value="price_high" {{ request('sortlist') == 'price_high' ? 'selected' : '' }}>Harga
                                    Tertinggi</option>
                                <option value="name_asc" {{ request('sortlist') == 'name_asc' ? 'selected' : '' }}>Nama A-Z
                                </option>
                                <option value="name_desc" {{ request('sortlist') == 'name_desc' ? 'selected' : '' }}>Nama
                                    Z-A
                                </option>
                            </select>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex flex-wrap items-center gap-3">
                        <button type="submit"
                            class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Cari
                        </button>

                        @if (request()->hasAny(['search', 'category', 'sort']))
                            <a href="{{ route('products.index') }}"
                                class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Reset
                            </a>
                        @endif

                        {{-- Active Filters Display --}}
                        <div class="flex-1 flex flex-wrap items-center gap-2">
                            @if (request('search'))
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-100 text-blue-800 rounded-lg text-sm font-medium">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    "{{ request('search') }}"
                                    <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                        class="hover:text-blue-900">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </a>
                                </span>
                            @endif
                        </div>

                        {{-- Results Count --}}
                        <div class="text-sm text-gray-600">
                            Menampilkan <span class="font-semibold">{{ $products->count() }}</span> dari <span
                                class="font-semibold">{{ $products->total() }}</span> produk
                        </div>
                    </div>
                </form>
            </div>

            {{-- Products Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                @forelse($products as $produk)
                    <div
                        class="group bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        {{-- Product Image --}}
                        <div class="relative overflow-hidden bg-gray-100">
                            @if ($produk->gambar)
                                <img src="{{ asset('storage/' . $produk->gambar) }}"
                                    class="w-full h-56 object-contain group-hover:scale-105 transition-transform duration-500"
                                    alt="{{ $produk->nama_produk }}">
                            @else
                                <div
                                    class="w-full h-56 bg-linear-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                    <div class="text-center">
                                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-2" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <p class="text-gray-400 text-sm">No Image</p>
                                    </div>
                                </div>
                            @endif

                            {{-- Quick View Badge --}}
                            <div class="absolute top-3 right-3">
                                <span
                                    class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-semibold text-gray-700 shadow-md">
                                    New
                                </span>
                            </div>
                        </div>

                        {{-- Product Info --}}
                        <div class="p-5">
                            {{-- Category Tag (Optional) --}}
                            @if (isset($produk->kategori))
                                <span
                                    class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-1 rounded-full mb-2">
                                    {{ $produk->kategori->nama_kategori }}
                                </span>
                            @endif

                            {{-- Product Name --}}
                            <h5 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 min-h-14">
                                {{ $produk->nama_produk }}
                            </h5>

                            {{-- Price --}}
                            <div class="mb-4">
                                <p class="text-2xl font-bold text-blue-600">
                                    Rp {{ number_format($produk->harga_produk, 0, ',', '.') }}
                                </p>
                            </div>

                            {{-- Stock Info (Optional) --}}
                            @if (isset($produk->stok_produk))
                                <div class="flex items-center gap-2 mb-4">
                                    <div class="flex-1 bg-gray-200 rounded-full h-1.5">
                                        <div class="bg-green-500 h-1.5 rounded-full"
                                            style="width: {{ min(($produk->stok_produk / 100) * 100, 100) }}%"></div>
                                    </div>
                                    <span class="text-xs font-medium text-gray-600">Stok:
                                        {{ $produk->stok_produk }}</span>
                                </div>
                            @endif

                            {{-- Action Buttons --}}
                            <div class="flex gap-2">
                                <a href="{{ route('products.show', $produk->id) }}"
                                    class="flex-1 bg-linear-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white text-center px-3 py-2 rounded-lg text-sm font-medium transition transform hover:scale-105 shadow-sm">
                                    <svg class="w-3.5 h-3.5 inline mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                    Detail
                                </a>
                                <form action="{{ route('cart.add', $produk->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit"
                                        class="w-full bg-linear-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition transform hover:scale-105 shadow-sm">
                                        <svg class="w-3.5 h-3.5 inline mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                        </svg>
                                        Keranjang
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div
                            class="bg-linear-to-r from-blue-50 to-indigo-50 border-2 border-blue-200 rounded-2xl p-12 text-center">
                            <svg class="w-24 h-24 mx-auto text-blue-300 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                </path>
                            </svg>
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">Produk Tidak Ditemukan</h3>
                            <p class="text-gray-600 mb-4">Belum ada produk yang sesuai dengan pencarian Anda</p>
                            <a href="{{ route('products.index') }}"
                                class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
                                Lihat Semua Produk
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if ($products->hasPages())
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
