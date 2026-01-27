@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Dashboard Admin</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-linear-to-r from-blue-500 to-blue-600 text-white rounded-lg shadow-lg p-6">
                <h5 class="text-lg font-semibold mb-2">Total Produk</h5>
                <h2 class="text-4xl font-bold">{{ $totalProduk }}</h2>
            </div>

            <div class="bg-linear-to-r from-green-500 to-green-600 text-white rounded-lg shadow-lg p-6">
                <h5 class="text-lg font-semibold mb-2">Total Penjualan</h5>
                <h2 class="text-4xl font-bold">{{ $totalPenjualan ?? '-' }}</h2>
            </div>

            <div class="bg-linear-to-r from-yellow-500 to-yellow-600 text-white rounded-lg shadow-lg p-6">
                <h5 class="text-lg font-semibold mb-2">Pending Orders</h5>
                <h2 class="text-4xl font-bold">{{ $pendingOrders ?? '-' }}</h2>
            </div>

            <div class="bg-linear-to-r from-purple-500 to-purple-600 text-white rounded-lg shadow-lg p-6">
                <h5 class="text-lg font-semibold mb-2">Total Customer</h5>
                <h2 class="text-4xl font-bold">{{ $totalCustomer ?? '-' }}</h2>
            </div>
        </div>

        {{-- Filter Bar --}}
     {{-- Modern Filter Bar --}}
<div class="bg-white rounded-2xl border border-gray-200 shadow-sm mb-6">
    <form method="GET" action="{{ url()->current() }}">
        {{-- Main Filter Row --}}
        <div class="p-5 border-b border-gray-100">
            <div class="flex flex-wrap items-center gap-3">
                {{-- Search Bar --}}
                <div class="flex-1 min-w-[280px] max-w-md">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search products by name..."
                            class="w-full pl-11 pr-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-gray-50 focus:bg-white">
                    </div>
                </div>

                {{-- Quick Status Filters (Pills) --}}
                <div class="flex flex-wrap gap-2">
                    <button type="submit" name="status" value=""
                        class="px-4 py-2 text-sm font-medium rounded-lg transition {{ !request('status') ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        All
                    </button>
                    <button type="submit" name="status" value="tersedia"
                        class="px-4 py-2 text-sm font-medium rounded-lg transition {{ request('status') == 'tersedia' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        In Stock
                    </button>
                    <button type="submit" name="status" value="hampir_habis"
                        class="px-4 py-2 text-sm font-medium rounded-lg transition {{ request('status') == 'hampir_habis' ? 'bg-yellow-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Low Stock
                    </button>
                    <button type="submit" name="status" value="habis"
                        class="px-4 py-2 text-sm font-medium rounded-lg transition {{ request('status') == 'habis' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Out of Stock
                    </button>
                </div>

                {{-- More Filters Toggle --}}
                <button type="button" onclick="toggleAdvancedFilters()"
                    class="ml-auto px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
                        </path>
                    </svg>
                    Advanced
                    <svg id="advanced-arrow" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Advanced Filters (Collapsible) --}}
        <div id="advanced-filters" class="hidden p-5 bg-gray-50 border-b border-gray-100">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                {{-- Category Filter --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-2">Category</label>
                    <select name="category" onchange="this.form.submit()"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-white">
                        <option value="">All Categories</option>
                        @foreach($categories ?? [] as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Stock Range Filter --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-2">Stock Level</label>
                    <select name="stock_range" onchange="this.form.submit()"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-white">
                        <option value="">All Stock Levels</option>
                        <option value="high" {{ request('stock_range') == 'high' ? 'selected' : '' }}>High (>50)</option>
                        <option value="medium" {{ request('stock_range') == 'medium' ? 'selected' : '' }}>Medium (11-50)</option>
                        <option value="low" {{ request('stock_range') == 'low' ? 'selected' : '' }}>Low (1-10)</option>
                        <option value="zero" {{ request('stock_range') == 'zero' ? 'selected' : '' }}>Out of Stock</option>
                    </select>
                </div>

                {{-- Price Range Filter --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-2">Price Range</label>
                    <select name="price_range" onchange="this.form.submit()"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-white">
                        <option value="">All Prices</option>
                        <option value="0-100000" {{ request('price_range') == '0-100000' ? 'selected' : '' }}>< Rp 100K</option>
                        <option value="100000-500000" {{ request('price_range') == '100000-500000' ? 'selected' : '' }}>Rp 100K - 500K</option>
                        <option value="500000-1000000" {{ request('price_range') == '500000-1000000' ? 'selected' : '' }}>Rp 500K - 1M</option>
                        <option value="1000000-999999999" {{ request('price_range') == '1000000-999999999' ? 'selected' : '' }}>> Rp 1M</option>
                    </select>
                </div>

                {{-- Sort By --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-2">Sort By</label>
                    <select name="sort" onchange="this.form.submit()"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-white">
                        <option value="">Default</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price (Low to High)</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price (High to Low)</option>
                        <option value="stock_asc" {{ request('sort') == 'stock_asc' ? 'selected' : '' }}>Stock (Low to High)</option>
                        <option value="stock_desc" {{ request('sort') == 'stock_desc' ? 'selected' : '' }}>Stock (High to Low)</option>
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Active Filters & Actions --}}
        <div class="px-5 py-3 bg-gray-50">
            <div class="flex flex-wrap items-center justify-between gap-3">
                {{-- Active Filters Display --}}
                <div class="flex flex-wrap items-center gap-2">
                    @if(request()->hasAny(['search', 'status', 'category', 'stock_range', 'price_range', 'sort']))
                        <span class="text-xs font-medium text-gray-600">Active Filters:</span>

                        @if(request('search'))
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-blue-100 text-blue-800 rounded-md text-xs font-medium">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                "{{ request('search') }}"
                                <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="hover:text-blue-900">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </a>
                            </span>
                        @endif

                        @if(request('status'))
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-green-100 text-green-800 rounded-md text-xs font-medium">
                                Status: {{ ucfirst(str_replace('_', ' ', request('status'))) }}
                                <a href="{{ request()->fullUrlWithQuery(['status' => null]) }}" class="hover:text-green-900">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </a>
                            </span>
                        @endif

                        @if(request('category'))
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-purple-100 text-purple-800 rounded-md text-xs font-medium">
                                Category
                                <a href="{{ request()->fullUrlWithQuery(['category' => null]) }}" class="hover:text-purple-900">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </a>
                            </span>
                        @endif

                        @if(request('stock_range'))
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-yellow-100 text-yellow-800 rounded-md text-xs font-medium">
                                Stock: {{ ucfirst(request('stock_range')) }}
                                <a href="{{ request()->fullUrlWithQuery(['stock_range' => null]) }}" class="hover:text-yellow-900">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </a>
                            </span>
                        @endif

                        @if(request('price_range'))
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-indigo-100 text-indigo-800 rounded-md text-xs font-medium">
                                Price Range
                                <a href="{{ request()->fullUrlWithQuery(['price_range' => null]) }}" class="hover:text-indigo-900">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </a>
                            </span>
                        @endif
                    @else
                        <span class="text-xs text-gray-500">No active filters</span>
                    @endif
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center gap-2">
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition">
                        Apply Filters
                    </button>
                    <a href="{{ url()->current() }}"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white hover:bg-gray-100 border border-gray-300 rounded-lg transition">
                        Clear All
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

{{-- JavaScript for Toggle --}}
<script>
    function toggleAdvancedFilters() {
        const filters = document.getElementById('advanced-filters');
        const arrow = document.getElementById('advanced-arrow');

        if (filters.classList.contains('hidden')) {
            filters.classList.remove('hidden');
            arrow.style.transform = 'rotate(180deg)';
        } else {
            filters.classList.add('hidden');
            arrow.style.transform = 'rotate(0deg)';
        }
    }

    // Auto-open advanced filters if any advanced filter is active
    document.addEventListener('DOMContentLoaded', function() {
        const hasAdvancedFilters = {{ request()->hasAny(['category', 'stock_range', 'price_range', 'sort']) ? 'true' : 'false' }};
        if (hasAdvancedFilters) {
            toggleAdvancedFilters();
        }
    });
</script>

        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h5 class="text-xl font-bold text-gray-800">Produk Terbaru</h5>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Harga</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Stok</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($latestProduks as $produk)
                            <tr class="hover:bg-gray-50 transition">
                                {{-- Product Info --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div
                                            class="w-12 h-12 shrink-0 bg-gray-100 rounded-lg flex items-center justify-center overflow-hidden">
                                            @if ($produk->gambar)
                                                <img src="{{ asset('storage/' . $produk->gambar) }}"
                                                    alt="{{ $produk->nama_produk }}" class="w-full h-full object-cover">
                                            @else
                                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-semibold text-gray-900">{{ $produk->nama_produk }}
                                            </div>
                                            <div class="text-xs text-gray-500">ID: {{ $produk->id }}</div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Price --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">Rp
                                        {{ number_format($produk->harga_produk, 0, ',', '.') }}</div>
                                </td>

                                {{-- Stock --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $produk->stok_produk }} units</div>
                                </td>

                                {{-- Status --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $badge = $produk->stock_badge;
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badge['bg'] }}  {{ $badge['text'] }}">
                                        <span class="w-2 h-2 mr-1.5 rounded-full {{ $badge['dot'] }}"></span>
                                        {{ $badge['label'] }}
                                    </span>
                                </td>

                                {{-- Date --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">{{ $produk->created_at->format('d M Y') }}</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $latestProduks->links() }}
@endsection
