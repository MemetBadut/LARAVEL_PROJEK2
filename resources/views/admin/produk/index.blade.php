@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Products</h1>
                <p class="text-gray-500 mt-1">Manage your product inventory</p>
            </div>
            <a href="{{ route('admin.products.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition font-medium">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Product
            </a>

        </div>

        {{-- Search & Filter --}}
        <div class="bg-white rounded-xl border border-gray-200 p-4 mb-6">
            <form action="{{ route('admin.products.index') }}" method="GET">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <input type="text" name="cari" id="cari" placeholder="Search products..."
                            value="{{ request('cari') }}" onchange="this.form.submit()"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <select
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option>All Categories</option>
                        <option>Elektronik</option>
                        <option>Fashion</option>
                        <option>Makanan</option>
                    </select>
                    <select onchange="this.form.submit()" name="status"
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">All Status</option>
                        <option value="tersedia" {{ request('status') === 'tersedia' ? 'selected' : '' }}>In Stock</option>
                        <option value="hampir_habis" {{ request('status') === 'hampir_habis' ? 'selected' : '' }}>Low Stock
                        </option>
                        <option value="habis" {{ request('status') === 'habis' ? 'selected' : '' }}>Out of Stock</option>
                    </select>
                </div>
            </form>
        </div>

        {{-- Products Table --}}
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Product
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Price
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Stock
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($produks as $key => $produk)
                            <tr class="hover:bg-gray-50 transition">
                                {{-- Product Info --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div
                                            class="w-12 h-12 shrink-0 bg-gray-100 rounded-lg flex items-center justify-center">
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

                                {{-- Actions --}}
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('admin.products.show', $produk->id) }}"
                                            class="text-gray-600 hover:text-blue-600 transition" title="View">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.products.edit', $produk->id) }}"
                                            class="text-gray-600 hover:text-blue-600 transition" title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $produk->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Delete this product?')"
                                                class="text-gray-600 hover:text-red-600 transition" title="Delete">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                        </path>
                                    </svg>
                                    <p class="text-gray-500 font-medium">No products found</p>
                                    <p class="text-gray-400 text-sm mt-1">Get started by adding your first product</p>
                                    <a href="{{ route('admin.products.create') }}"
                                        class="inline-flex items-center mt-4 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition text-sm font-medium">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4"></path>
                                        </svg>
                                        Add First Product
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($produks->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $produks->links() }}
                </div>
            @endif
        </div>

        {{-- Summary Stats --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
            <div class="bg-white rounded-xl border border-gray-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide">Total Products</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $produks->total() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide">In Stock</p>
                        <p class="text-2xl font-bold text-green-600 mt-1">
                            {{ $countStok->stokReady }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide">Low Stock</p>
                        <p class="text-2xl font-bold text-yellow-600 mt-1">
                            {{ $countStok->stokLow }}</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
