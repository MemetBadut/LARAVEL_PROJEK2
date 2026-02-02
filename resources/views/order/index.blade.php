@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">My Orders</h1>
            <p class="text-gray-500 mt-1">View your order details and track status</p>
        </div>

        <div class="max-w-4xl mx-auto">
            {{-- Order Invoice Card --}}
            <div class="bg-white rounded-xl border border-gray-200 shadow-lg">
                {{-- Invoice Header --}}
                <div class="px-6 py-6 bg-linear-to-r from-blue-600 to-blue-700 text-white rounded-t-xl">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h2 class="text-2xl font-bold">Order Invoice</h2>
                            <p class="text-blue-100 text-sm mt-1">Order #{{ $orderId ?? '12345' }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-blue-100">Order Date</p>
                            <p class="font-semibold">{{ now()->format('d M Y') }}</p>
                        </div>
                    </div>

                    {{-- Status Badge --}}
                    <div class="inline-flex items-center px-4 py-2 bg-white bg-opacity-20 rounded-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-semibold">Processing</span>
                    </div>
                </div>

                {{-- Order Items --}}
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Order Items</h3>
                    <div class="space-y-4">
                        @php $subtotal = 0; @endphp
                        @foreach ($orders as $order)
                            @foreach ($order->orderItems as $item)
                                @php
                                    $itemTotal = $item->harga_satuan * $item->jumlah_barang;
                                    $subtotal += $itemTotal;
                                @endphp
                                <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                    {{-- Product Image --}}
                                    <div
                                        class="w-20 h-20 bg-white rounded-lg overflow-hidden shrink-0 border border-gray-200">
                                        @if ($item->produk->gambar ?? null)
                                            <img src="{{ asset('storage/' . $item->produk->gambar) }}"
                                                alt="{{ $item->produk->nama_produk }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4">
                                                    </path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- @php
                                        dd($item->produk->nama_produk);
                                    @endphp --}}

                                    {{-- Product Info --}}
                                    <div class="flex-1">
                                        <h4 class="font-bold text-gray-900 mb-1">
                                            {{ $item->produk->nama_produk ?? 'Product Name' }}
                                        </h4>
                                        <p class="text-sm text-gray-600">
                                            {{ $item->jumlah_barang ?? 1 }} item(s) × Rp
                                            {{ number_format($item->harga_satuan ?? 0, 0, ',', '.') }}
                                        </p>
                                        @if ($item->produk->sku ?? null)
                                            <p class="text-xs text-gray-500 mt-1">SKU: {{ $item->produk->sku }}</p>
                                        @endif
                                    </div>

                                    {{-- Item Total --}}
                                    <div class="text-right">
                                        <p class="text-lg font-bold text-gray-900">
                                            Rp {{ number_format($itemTotal, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>

                {{-- Price Summary --}}
                <div class="px-6 pb-6">
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Payment Summary</h3>

                        <div class="space-y-3">
                            {{-- Subtotal --}}
                            <div class="flex justify-between text-gray-700">
                                <span>Subtotal ({{ count($orders) }} items)</span>
                                <span class="font-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>

                            {{-- Shipping --}}
                            <div class="flex justify-between text-gray-700">
                                <div>
                                    <p>Shipping Fee</p>
                                    <p class="text-xs text-gray-500">Regular Shipping (3-5 days)</p>
                                </div>
                                <span class="font-semibold">Rp 15.000</span>
                            </div>

                            {{-- Tax --}}
                            <div class="flex justify-between text-gray-700">
                                <span>Tax (11%)</span>
                                <span class="font-semibold">Rp {{ number_format($subtotal * 0.11, 0, ',', '.') }}</span>
                            </div>

                            {{-- Service Fee --}}
                            <div class="flex justify-between text-gray-700">
                                <span>Service Fee</span>
                                <span class="font-semibold">Rp 1.000</span>
                            </div>

                            {{-- Discount (if any) --}}
                            <div class="flex justify-between text-green-600">
                                <span>Discount</span>
                                <span class="font-semibold">- Rp 0</span>
                            </div>

                            {{-- Divider --}}
                            <div class="border-t-2 border-gray-300 pt-4 mt-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-xl font-bold text-gray-900">Total Payment</span>
                                    <span class="text-3xl font-bold text-blue-600">
                                        Rp {{ number_format($subtotal + 15000 + $subtotal * 0.11 + 1000, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Shipping Address --}}
                <div class="px-6 pb-6">
                    @foreach ($orders as $order)
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                            <div class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-blue-600 shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-2">Shipping Address</h4>
                                    <p class="text-gray-700 leading-relaxed">
                                        {{ $order->alamat_pengiriman ?? 'Jl. Contoh No. 123, Kelurahan Contoh' }}<br>
                                        {{ $order->kota ?? 'Jakarta Selatan' }}, {{ $order->kode_pos ?? '12345' }}<br>
                                        {{ $order->provinsi ?? 'Indonesia' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                {{-- Actions --}}
                <div class="px-6 pb-6 flex gap-3">
                    <a href="#"{{--  route('orders.track', $orderId ?? 1) --}}
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center py-3 rounded-lg font-bold transition">
                        Track Order
                    </a>
                    <button onclick="window.print()"
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-900 text-center py-3 rounded-lg font-bold transition">
                        Print Invoice
                    </button>
                    <a href="{{ route('orders.index') }}"
                        class="px-6 bg-gray-100 hover:bg-gray-200 text-gray-900 text-center py-3 rounded-lg font-bold transition">
                        Back
                    </a>
                </div>
            </div>

            {{-- Help Section --}}
            <div class="mt-6 bg-white rounded-xl border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">Need Help?</h3>
                            <p class="text-sm text-gray-600">Contact our customer support</p>
                        </div>
                    </div>
                    <a href="#"{{-- route('support')  --}}
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
