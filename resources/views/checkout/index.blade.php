@extends('layouts.app')

@section('content')
    <div class="bg-gray-50 min-h-screen py-8">
        <div class="container mx-auto px-4">

            {{-- Progress Steps --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <div
                            class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center text-white font-bold">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <span class="font-semibold text-gray-900">Cart</span>
                    </div>
                    <div class="flex-1 h-1 bg-green-600 mx-4"></div>

                    <div class="flex items-center space-x-2">
                        <div
                            class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                            2
                        </div>
                        <span class="font-semibold text-blue-600">Checkout</span>
                    </div>
                    <div class="flex-1 h-1 bg-gray-200 mx-4"></div>

                    <div class="flex items-center space-x-2">
                        <div
                            class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 font-bold">
                            3
                        </div>
                        <span class="font-medium text-gray-500">Payment</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Left Column - Forms --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Shipping Address --}}
                    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex items-center justify-between">
                            <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Shipping Address
                            </h3>
                            <button class="text-blue-600 hover:text-blue-700 text-sm font-semibold">Change</button>
                        </div>

                        <div class="p-6">
                            @if ($alamatUser)
                                <div class="border-2 border-blue-500 rounded-lg p-4 bg-blue-50">
                                    <div class="flex items-start justify-between mb-2">
                                        <div>
                                            <div class="flex items-center space-x-2 mb-1">
                                                <span
                                                    class="font-bold text-gray-900">{{ $alamatUser->recipient_name }}</span>
                                                <span
                                                    class="px-2 py-0.5 bg-blue-600 text-white text-xs font-semibold rounded">Main</span>
                                            </div>
                                            <p class="text-gray-600 text-sm">{{ $defaultAddress->phone }}</p>
                                        </div>
                                    </div>
                                    <p class="text-gray-700 text-sm leading-relaxed">
                                        {{ $alamatUser->alamat_lengkap }}<br>
                                        {{ $alamatUser->daerah }}, {{ $alamatUser->kota }}<br>
                                        {{ $alamatUser->provinsi }} {{ $alamatUser->kode_pos }}
                                    </p>
                                </div>
                            @else
                                <button
                                    class="w-full py-8 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-500 transition text-gray-500 hover:text-blue-600">
                                    <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    <p class="font-semibold">Add Shipping Address</p>
                                </button>
                            @endif
                        </div>
                    </div>

                    {{-- Products Review --}}
                    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                            <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                Products Ordered ({{ count($cartItems) }} items)
                            </h3>
                        </div>

                        <div class="divide-y divide-gray-200">
                            @foreach ($cartItems as $item)
                                <div class="p-6">
                                    <div class="flex items-start space-x-4">
                                        <div
                                            class="w-20 h-20 bg-gray-100 rounded-lg flex items-center justify-center overflow-hidden shrink-0">
                                            @if ($item->produk->gambar)
                                                 <img src="{{ asset('storage/' . $item->product->gambar1) }}"
                                                    alt="{{ $item['nama_produk'] }}" class="w-full h-full object-cover">
                                            @else
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-semibold text-gray-900 mb-1">{{ $item['nama_produk'] }}</h4>
                                            <p class="text-sm text-gray-500 mb-2">{{ $item['quantity'] }} item(s) × Rp
                                                {{ number_format($item['harga_produk'], 0, ',', '.') }}</p>

                                            {{-- Notes --}}
                                            <div class="mt-3">
                                                <input type="text" placeholder="Add note for seller (optional)"
                                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-gray-900">Rp
                                                {{ number_format($item['harga_produk'] * $item['quantity'], 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Shipping Options --}}
                    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                            <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                                    </path>
                                </svg>
                                Shipping Method
                            </h3>
                        </div>

                        <div class="p-6 space-y-3">
                            <label
                                class="flex items-center justify-between p-4 border-2 border-blue-500 bg-blue-50 rounded-lg cursor-pointer">
                                <div class="flex items-center space-x-3">
                                    <input type="radio" name="shipping" value="regular" checked
                                        class="w-5 h-5 text-blue-600">
                                    <div>
                                        <p class="font-semibold text-gray-900">Regular Shipping</p>
                                        <p class="text-sm text-gray-500">Estimated 3-5 days</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-gray-900">Rp 15.000</p>
                                </div>
                            </label>

                            <label
                                class="flex items-center justify-between p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-300 transition">
                                <div class="flex items-center space-x-3">
                                    <input type="radio" name="shipping" value="express" class="w-5 h-5 text-blue-600">
                                    <div>
                                        <p class="font-semibold text-gray-900">Express Shipping</p>
                                        <p class="text-sm text-gray-500">Estimated 1-2 days</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-gray-900">Rp 25.000</p>
                                </div>
                            </label>

                            <label
                                class="flex items-center justify-between p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-300 transition">
                                <div class="flex items-center space-x-3">
                                    <input type="radio" name="shipping" value="same-day"
                                        class="w-5 h-5 text-blue-600">
                                    <div>
                                        <p class="font-semibold text-gray-900">Same Day Delivery</p>
                                        <p class="text-sm text-gray-500">Order before 12 PM</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-gray-900">Rp 35.000</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    {{-- Payment Method --}}
                    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                            <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                    </path>
                                </svg>
                                Payment Method
                            </h3>
                        </div>

                        <div class="p-6">
                            <div class="space-y-2">
                                {{-- E-Wallet --}}
                                <details class="group border border-gray-200 rounded-lg">
                                    <summary class="flex items-center justify-between p-4 cursor-pointer hover:bg-gray-50">
                                        <span class="font-semibold text-gray-900">E-Wallet</span>
                                        <svg class="w-5 h-5 text-gray-500 group-open:rotate-180 transition" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </summary>
                                    <div class="px-4 pb-4 space-y-2">
                                        <label
                                            class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-blue-50 hover:border-blue-300">
                                            <input type="radio" name="payment" value="gopay"
                                                class="w-4 h-4 text-blue-600">
                                            <span class="ml-3 flex items-center">
                                                <span class="font-semibold text-green-600 mr-2">GoPay</span>
                                            </span>
                                        </label>
                                        <label
                                            class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-blue-50 hover:border-blue-300">
                                            <input type="radio" name="payment" value="ovo"
                                                class="w-4 h-4 text-blue-600">
                                            <span class="ml-3 flex items-center">
                                                <span class="font-semibold text-purple-600 mr-2">OVO</span>
                                            </span>
                                        </label>
                                        <label
                                            class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-blue-50 hover:border-blue-300">
                                            <input type="radio" name="payment" value="dana"
                                                class="w-4 h-4 text-blue-600">
                                            <span class="ml-3 flex items-center">
                                                <span class="font-semibold text-blue-600 mr-2">DANA</span>
                                            </span>
                                        </label>
                                    </div>
                                </details>

                                {{-- Bank Transfer --}}
                                <details class="group border border-gray-200 rounded-lg">
                                    <summary class="flex items-center justify-between p-4 cursor-pointer hover:bg-gray-50">
                                        <span class="font-semibold text-gray-900">Bank Transfer</span>
                                        <svg class="w-5 h-5 text-gray-500 group-open:rotate-180 transition" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </summary>
                                    <div class="px-4 pb-4 space-y-2">
                                        <label
                                            class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-blue-50 hover:border-blue-300">
                                            <input type="radio" name="payment" value="bca"
                                                class="w-4 h-4 text-blue-600">
                                            <span class="ml-3 font-semibold text-gray-900">BCA Virtual Account</span>
                                        </label>
                                        <label
                                            class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-blue-50 hover:border-blue-300">
                                            <input type="radio" name="payment" value="mandiri"
                                                class="w-4 h-4 text-blue-600">
                                            <span class="ml-3 font-semibold text-gray-900">Mandiri Virtual Account</span>
                                        </label>
                                        <label
                                            class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-blue-50 hover:border-blue-300">
                                            <input type="radio" name="payment" value="bni"
                                                class="w-4 h-4 text-blue-600">
                                            <span class="ml-3 font-semibold text-gray-900">BNI Virtual Account</span>
                                        </label>
                                    </div>
                                </details>

                                {{-- Credit Card --}}
                                <label
                                    class="flex items-center justify-between p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-300 transition">
                                    <div class="flex items-center space-x-3">
                                        <input type="radio" name="payment" value="credit-card"
                                            class="w-5 h-5 text-blue-600">
                                        <span class="font-semibold text-gray-900">Credit/Debit Card</span>
                                    </div>
                                    <div class="flex space-x-1">
                                        <span class="text-xs bg-gray-100 px-2 py-1 rounded">VISA</span>
                                        <span class="text-xs bg-gray-100 px-2 py-1 rounded">Mastercard</span>
                                    </div>
                                </label>

                                {{-- COD --}}
                                <label
                                    class="flex items-center justify-between p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-300 transition">
                                    <div class="flex items-center space-x-3">
                                        <input type="radio" name="payment" value="cod"
                                            class="w-5 h-5 text-blue-600">
                                        <div>
                                            <p class="font-semibold text-gray-900">Cash on Delivery (COD)</p>
                                            <p class="text-xs text-gray-500">Pay when you receive</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Column - Order Summary --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl border border-gray-200 sticky top-4">
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                            <h3 class="text-lg font-bold text-gray-900">Order Summary</h3>
                        </div>

                        <div class="p-6 space-y-4">
                            {{-- Subtotal --}}
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal ({{ count($cartItems) }} items)</span>
                                <span class="font-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>

                            {{-- Shipping --}}
                            <div class="flex justify-between text-gray-600">
                                <span>Shipping Fee</span>
                                <span class="font-semibold">Rp 15.000</span>
                            </div>

                            {{-- Service Fee --}}
                            <div class="flex justify-between text-gray-600">
                                <span>Service Fee</span>
                                <span class="font-semibold">Rp 1.000</span>
                            </div>

                            {{-- Voucher --}}
                            <div class="border-t border-gray-200 pt-4">
                                <button
                                    class="w-full flex items-center justify-between p-3 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-500 transition">
                                    <div class="flex items-center space-x-2 text-blue-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z">
                                            </path>
                                        </svg>
                                        <span class="font-semibold">Use Voucher</span>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            </div>

                            {{-- Total --}}
                            <div class="border-t border-gray-200 pt-4">
                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-lg font-bold text-gray-900">Total Payment</span>
                                    <div class="text-right">
                                        <p class="text-2xl font-bold text-blue-600">Rp
                                            {{ number_format($total, 0, ',', '.') }}</p>
                                    </div>
                                </div>

                                {{-- Place Order Button --}}
                                <button
                                    class="w-full bg-linear-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white py-4 rounded-lg font-bold text-lg transition transform hover:scale-105 shadow-lg">
                                    Place Order
                                </button>

                                {{-- Terms --}}
                                <p class="text-xs text-gray-500 text-center mt-4">
                                    By placing an order, you agree to our
                                    <a href="#" class="text-blue-600 hover:underline">Terms & Conditions</a>
                                </p>
                            </div>

                            {{-- Security Badge --}}
                            <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                                <div class="flex items-center space-x-2 text-green-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                        </path>
                                    </svg>
                                    <span class="text-sm font-semibold">Secure Payment</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
