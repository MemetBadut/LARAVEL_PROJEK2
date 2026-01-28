@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-linear-to-br from-gray-50 to-gray-100">
        <div class="container mx-auto px-4 py-8">

            {{-- Header Section --}}
            <div class="mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 mb-2">
                            Welcome back, <span class="text-blue-600">{{ $users ?? 'Vendor' }}</span> 👋
                        </h1>
                        <p class="text-gray-600">Manage your store and track your performance</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <div class="flex items-center gap-3 bg-white rounded-xl px-4 py-3 shadow-sm border border-gray-200">
                            <div
                                class="w-10 h-10 bg-linear-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                                {{ strtoupper(substr($users ?? 'V', 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">{{ $vendor->store_name ?? 'Your Store' }}</p>
                                <p class="text-xs text-gray-500">Vendor Account</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                {{-- Total Products --}}
                <div
                    class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-gray-500 text-sm font-medium mb-1">Total Products</h3>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalStok ?? 0 }}</p>
                </div>

                {{-- Total Sales --}}
                <div
                    class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-gray-500 text-sm font-medium mb-1">Total Revenue</h3>
                    <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</p>
                </div>

                {{-- Orders --}}
                <div
                    class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-gray-500 text-sm font-medium mb-1">Total Orders</h3>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalOrders ?? 0 }}</p>
                </div>

                {{-- Low Stock --}}
                <div
                    class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                </path>
                            </svg>
                        </div>
                        <span class="text-yellow-600 text-sm font-semibold">Alert</span>
                    </div>
                    <h3 class="text-gray-500 text-sm font-medium mb-1">Low Stock Items</h3>
                    <p class="text-3xl font-bold text-gray-900">{{ $lowStok ?? 0 }}</p>
                </div>
            </div>

            {{-- Main Navigation Cards --}}
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Quick Actions</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">

                    {{-- Cek Produk --}}
                    <a href="{{ route('vendor.products.index') }}"
                        class="group relative bg-linear-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:scale-105">
                        <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity"></div>
                        <div class="relative p-8">
                            <div
                                class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-2">Cek Produk</h3>
                            <p class="text-blue-100 text-sm mb-4">Lihat dan kelola semua produk Anda</p>
                            <div class="flex items-center text-white text-sm font-medium">
                                View Products
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    </a>

                    {{-- Hasil Penjualan --}}
                    <a href="#"{{-- {{ route('vendor.sales.index') }} --}}
                        class="group relative bg-linear-to-br from-green-500 to-green-600 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:scale-105">
                        <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity"></div>
                        <div class="relative p-8">
                            <div
                                class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-2">Hasil Penjualan</h3>
                            <p class="text-green-100 text-sm mb-4">Lihat laporan dan analytics penjualan</p>
                            <div class="flex items-center text-white text-sm font-medium">
                                View Sales
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    </a>

                    {{-- Tambah Barang --}}
                    <a href="{{ route('vendor.products.create') }}"
                        class="group relative bg-linear-to-br from-purple-500 to-purple-600 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:scale-105">
                        <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity"></div>
                        <div class="relative p-8">
                            <div
                                class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-2">Tambah Barang</h3>
                            <p class="text-purple-100 text-sm mb-4">Tambahkan produk baru ke toko</p>
                            <div class="flex items-center text-white text-sm font-medium">
                                Add Product
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    </a>

                    {{-- Kelola Barang --}}
                    <a href="#"{{-- {{ route('vendor.products.manage') }} --}}
                        class="group relative bg-linear-to-br from-orange-500 to-orange-600 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:scale-105">
                        <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity"></div>
                        <div class="relative p-8">
                            <div
                                class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-2">Kelola Barang</h3>
                            <p class="text-orange-100 text-sm mb-4">Edit, hapus, dan atur produk</p>
                            <div class="flex items-center text-white text-sm font-medium">
                                Manage Products
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    </a>

                    {{-- Dashboard --}}
                    <a href="{{ route('vendor.vendorDashboard') }}"{{-- {{ route('vendor.products.manage') }} --}}
                        class="group relative bg-linear-to-br from-yellow-500 to-yellow-600 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:scale-105">
                        <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity"></div>
                        <div class="relative p-8">
                            <div
                                class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                {{-- <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg> --}}
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-9 text-white" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M14 21C13.4477 21 13 20.5523 13 20V12C13 11.4477 13.4477 11 14 11H20C20.5523 11 21 11.4477 21 12V20C21 20.5523 20.5523 21 20 21H14ZM4 13C3.44772 13 3 12.5523 3 12V4C3 3.44772 3.44772 3 4 3H10C10.5523 3 11 3.44772 11 4V12C11 12.5523 10.5523 13 10 13H4ZM9 11V5H5V11H9ZM4 21C3.44772 21 3 20.5523 3 20V16C3 15.4477 3.44772 15 4 15H10C10.5523 15 11 15.4477 11 16V20C11 20.5523 10.5523 21 10 21H4ZM5 19H9V17H5V19ZM15 19H19V13H15V19ZM13 4C13 3.44772 13.4477 3 14 3H20C20.5523 3 21 3.44772 21 4V8C21 8.55228 20.5523 9 20 9H14C13.4477 9 13 8.55228 13 8V4ZM15 5V7H19V5H15Z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-2">Dashboard</h3>
                            <p class="text-orange-100 text-sm mb-4">Cek penjualan,Cek Produk, </p>
                            <div class="flex items-center text-white text-sm font-medium">
                                Manage Products
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">,
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    </a>

                </div>
            </div>

            {{-- Recent Activity Section --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- Recent Orders --}}
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Recent Orders</h3>
                        <a href="#" {{-- {{ route('vendor.orders.index') }} --}}
                            class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                            View All →
                        </a>
                    </div>
                    <div class="space-y-4">
                        @forelse($recentOrders ?? [] as $order)
                            <div
                                class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">Order #{{ $order->id }}</p>
                                        <p class="text-sm text-gray-500">{{ $order->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-gray-900">Rp {{ number_format($order->total, 0, ',', '.') }}
                                    </p>
                                    <span
                                        class="inline-block px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                        {{ $order->status }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                <p class="text-gray-500">No recent orders</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Top Products --}}
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Top Products</h3>
                        <a href="{{ route('vendor.products.index') }}"
                            class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                            View All →
                        </a>
                    </div>
                    <div class="space-y-4">
                        @forelse($topProducts ?? [] as $product)
                            <div
                                class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 bg-linear-to-br from-purple-400 to-purple-600 rounded-lg flex items-center justify-center overflow-hidden">
                                        @if ($product->gambar)
                                            <img src="{{ asset('storage/' . $product->image) }}"
                                                alt="{{ $product->name }}" class="w-full h-full object-cover">
                                        @else
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $product->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $product->sales_count ?? 0 }} sold</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-gray-900">Rp
                                        {{ number_format($product->price, 0, ',', '.') }}</p>
                                    <p class="text-sm text-gray-500">Stock: {{ $product->stock }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <p class="text-gray-500">No products yet</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
