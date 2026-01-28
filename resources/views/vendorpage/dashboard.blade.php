@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
        <div class="container mx-auto px-4 py-8">

            {{-- Header --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Analytics Dashboard</h1>
                    <p class="text-gray-600">Track your store performance and insights</p>
                </div>
                <div class="mt-4 md:mt-0 flex gap-3">
                    <select
                        class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option>Last 7 days</option>
                        <option>Last 30 days</option>
                        <option>Last 3 months</option>
                        <option>This year</option>
                    </select>
                    <button
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Export
                    </button>
                </div>
            </div>

            {{-- Key Metrics --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                {{-- Revenue --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <span class="flex items-center text-sm font-semibold text-green-600">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                            </svg>
                            12.5%
                        </span>
                    </div>
                    <p class="text-sm text-gray-600 mb-1">Total Revenue</p>
                    <p class="text-2xl font-bold text-gray-900">Rp
                        {{ number_format($totalRevenue ?? 15750000, 0, ',', '.') }}</p>
                </div>

                {{-- Orders --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <span class="flex items-center text-sm font-semibold text-green-600">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                            </svg>
                            8.2%
                        </span>
                    </div>
                    <p class="text-sm text-gray-600 mb-1">Total Orders</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalOrders ?? 342 }}</p>
                </div>

                {{-- Avg Order Value --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <span class="flex items-center text-sm font-semibold text-green-600">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                            </svg>
                            5.4%
                        </span>
                    </div>
                    <p class="text-sm text-gray-600 mb-1">Avg Order Value</p>
                    <p class="text-2xl font-bold text-gray-900">Rp
                        {{ number_format($avgOrderValue ?? 460000, 0, ',', '.') }}</p>
                </div>

                {{-- Conversion Rate --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <span class="flex items-center text-sm font-semibold text-red-600">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                            </svg>
                            2.1%
                        </span>
                    </div>
                    <p class="text-sm text-gray-600 mb-1">Conversion Rate</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $conversionRate ?? 3.2 }}%</p>
                </div>
            </div>

            {{-- Charts Section --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                {{-- Revenue Chart --}}
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-bold text-gray-900">Revenue Overview</h3>
                        <div class="flex gap-2">
                            <button
                                class="px-3 py-1 text-xs font-medium bg-blue-100 text-blue-700 rounded-lg">Daily</button>
                            <button
                                class="px-3 py-1 text-xs font-medium text-gray-600 hover:bg-gray-100 rounded-lg">Weekly</button>
                            <button
                                class="px-3 py-1 text-xs font-medium text-gray-600 hover:bg-gray-100 rounded-lg">Monthly</button>
                        </div>
                    </div>
                    <div class="h-64 flex items-end justify-between gap-2">
                        {{-- Simple Bar Chart --}}
                        @foreach (['Mon' => 65, 'Tue' => 78, 'Wed' => 90, 'Thu' => 72, 'Fri' => 85, 'Sat' => 95, 'Sun' => 88] as $day => $value)
                            <div class="flex-1 flex flex-col items-center group">
                                <div class="w-full bg-gradient-to-t from-blue-500 to-blue-400 rounded-t-lg hover:from-blue-600 hover:to-blue-500 transition cursor-pointer relative"
                                    style="height: {{ $value }}%">
                                    <span
                                        class="absolute -top-8 left-1/2 transform -translate-x-1/2 text-xs font-semibold text-gray-700 opacity-0 group-hover:opacity-100 transition">
                                        Rp {{ number_format($value * 20000, 0, ',', '.') }}
                                    </span>
                                </div>
                                <span class="text-xs text-gray-600 mt-2">{{ $day }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Top Products --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Top Products</h3>
                    <div class="space-y-4">
                        @foreach ([['name' => 'Product A', 'sales' => 156, 'revenue' => 7800000, 'color' => 'blue'], ['name' => 'Product B', 'sales' => 134, 'revenue' => 6700000, 'color' => 'green'], ['name' => 'Product C', 'sales' => 98, 'revenue' => 4900000, 'color' => 'purple'], ['name' => 'Product D', 'sales' => 76, 'revenue' => 3800000, 'color' => 'orange']] as $product)
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 bg-{{ $product['color'] }}-100 rounded-lg flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-{{ $product['color'] }}-600" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-900 truncate">{{ $product['name'] }}</p>
                                    <p class="text-xs text-gray-500">{{ $product['sales'] }} sales</p>
                                </div>
                                <p class="text-sm font-bold text-gray-900">Rp
                                    {{ number_format($product['revenue'], 0, ',', '.') }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Bottom Section --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Recent Transactions --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-bold text-gray-900">Recent Transactions</h3>
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-700 font-medium">View All →</a>
                    </div>
                    <div class="space-y-4">
                        @foreach ([['id' => '12345', 'customer' => 'John Doe', 'amount' => 450000, 'status' => 'completed', 'time' => '5 min ago'], ['id' => '12344', 'customer' => 'Jane Smith', 'amount' => 780000, 'status' => 'completed', 'time' => '12 min ago'], ['id' => '12343', 'customer' => 'Bob Wilson', 'amount' => 320000, 'status' => 'pending', 'time' => '23 min ago'], ['id' => '12342', 'customer' => 'Alice Brown', 'amount' => 560000, 'status' => 'completed', 'time' => '1 hour ago']] as $transaction)
                            <div
                                class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                        {{ strtoupper(substr($transaction['customer'], 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">{{ $transaction['customer'] }}</p>
                                        <p class="text-xs text-gray-500">Order #{{ $transaction['id'] }} •
                                            {{ $transaction['time'] }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-bold text-gray-900">Rp
                                        {{ number_format($transaction['amount'], 0, ',', '.') }}</p>
                                    <span
                                        class="inline-block px-2 py-0.5 text-xs font-medium rounded-full {{ $transaction['status'] == 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($transaction['status']) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Sales by Category --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-6">Sales by Category</h3>
                    <div class="space-y-4">
                        @foreach ([['name' => 'Electronics', 'sales' => 45, 'color' => 'blue', 'amount' => 6750000], ['name' => 'Fashion', 'sales' => 32, 'color' => 'pink', 'amount' => 4800000], ['name' => 'Food & Beverage', 'sales' => 28, 'color' => 'green', 'amount' => 4200000], ['name' => 'Home & Living', 'sales' => 18, 'color' => 'purple', 'amount' => 2700000], ['name' => 'Others', 'sales' => 12, 'color' => 'gray', 'amount' => 1800000]] as $category)
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-2">
                                        <div class="w-3 h-3 bg-{{ $category['color'] }}-500 rounded-full"></div>
                                        <span class="text-sm font-medium text-gray-900">{{ $category['name'] }}</span>
                                    </div>
                                    <span class="text-sm font-bold text-gray-900">{{ $category['sales'] }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-{{ $category['color'] }}-500 h-2 rounded-full transition-all duration-500"
                                        style="width: {{ $category['sales'] }}%"></div>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Rp
                                    {{ number_format($category['amount'], 0, ',', '.') }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
