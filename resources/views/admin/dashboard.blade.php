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
        <div class="bg-white rounded-xl border border-gray-200 p-4 mb-4">
            <form method="GET" action="{{ url()->current() }}" class="space-y-4">
                <div class="flex flex-col md:flex-row gap-3">
                    {{-- Search --}}
                    <div class="flex-1">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}"
                                onchange="this.form.submit()" placeholder="Search products..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        </div>
                    </div>

                    {{-- Filter by Status --}}
                    <select name="status" onchange="this.form.submit()"
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        <option value="">All Status</option>
                        <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="hampir_habis" {{ request('status') == 'hampir_habis' ? 'selected' : '' }}> Hampir
                            Habis</option>
                        <option value="habis" {{ request('status') == 'habis' ? 'selected' : '' }}>Habis</option>
                    </select>

                    {{-- Filter by Stock Range --}}
                    <select name="stock_range" onchange="this.form.submit()"
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        <option value="">All Stock</option>
                        <option value="high" {{ request('stock_range') == 'high' ? 'selected' : '' }}>High Stock (>50)
                        </option>
                        <option value="medium" {{ request('stock_range') == 'medium' ? 'selected' : '' }}>Medium Stock
                            (11-50)</option>
                        <option value="low" {{ request('stock_range') == 'low' ? 'selected' : '' }}>Low Stock (1-10)
                        </option>
                        <option value="zero" {{ request('stock_range') == 'zero' ? 'selected' : '' }}>Out of Stock (0)
                        </option>
                    </select>

                    {{-- Filter Button --}}
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition font-medium flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                            </path>
                        </svg>
                        Filter
                    </button>

                    {{-- Reset Button --}}
                    <a href="{{ url()->current() }}"
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition font-medium flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        Reset
                    </a>
                </div>
            </form>
        </div>

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
                                    @if ($produk->stok_produk >= 10)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <span class="w-2 h-2 mr-1.5 rounded-full bg-green-400"></span>
                                            In Stock
                                        </span>
                                    @elseif($produk->stok_produk <= 10)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <span class="w-2 h-2 mr-1.5 rounded-full bg-yellow-400"></span>
                                            Low Stock
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <span class="w-2 h-2 mr-1.5 rounded-full bg-red-400"></span>
                                            Out of Stock
                                        </span>
                                    @endif
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
