<!-- resources/views/profile/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-7xl mx-auto">

            <!-- Cover Image -->
            <div
                class="bg-linear-to-r from-blue-500 via-purple-500 to-pink-500 h-64 rounded-t-2xl relative overflow-hidden">
                <div class="absolute inset-0 bg-black opacity-20"></div>
                <div class="absolute bottom-0 left-0 right-0 p-8">
                    <div class="flex items-end justify-between">
                        <!-- Avatar & Name -->
                        <div class="flex items-end space-x-6">
                            <div class="relative">
                                @if ($user->avatar)
                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}"
                                        class="w-32 h-32 rounded-full border-4 border-white shadow-xl object-cover">
                                @else
                                    <div
                                        class="w-32 h-32 rounded-full border-4 border-white shadow-xl bg-linear-to-br from-blue-600 to-purple-600 flex items-center justify-center text-5xl font-bold text-white">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                @endif
                                <!-- Online Status -->
                                <div
                                    class="absolute bottom-2 right-2 w-6 h-6 bg-green-500 rounded-full border-4 border-white">
                                </div>
                            </div>
                            <div class="mb-2">
                                <h1 class="text-3xl font-bold text-white mb-1">{{ $user->name }}</h1>
                                <p class="text-white text-opacity-90 flex items-center">
                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    {{ $user->email }}
                                </p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        @if (auth()->id() === $user->id)
                            <div class="flex space-x-3 mb-4">
                                <a href="{{ route('profile.edit') }}"
                                    class="bg-white text-gray-800 px-6 py-2 rounded-lg font-semibold hover:bg-gray-100 transition shadow-lg flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                    Edit Profile
                                </a>
                                <button
                                    class="bg-gray-800 bg-opacity-50 text-white px-6 py-2 rounded-lg font-semibold hover:bg-opacity-70 transition shadow-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">

                <!-- Left Sidebar -->
                <div class="lg:col-span-1 space-y-6">

                    <!-- About Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Tentang
                        </h3>

                        <div class="space-y-4">
                            @if ($user->bio)
                                <div>
                                    <p class="text-gray-600 text-sm leading-relaxed">{{ $user->bio }}</p>
                                </div>
                            @endif

                            <div class="space-y-3">
                                @if ($user->phone)
                                    <div class="flex items-center text-sm">
                                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                            </path>
                                        </svg>
                                        <span class="text-gray-700">{{ $user->phone }}</span>
                                    </div>
                                @endif

                                @if ($user->location)
                                    <div class="flex items-center text-sm">
                                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span class="text-gray-700">{{ $user->location }}</span>
                                    </div>
                                @endif

                                <div class="flex items-center text-sm">
                                    <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span class="text-gray-700">Bergabung {{ $user->created_at->format('F Y') }}</span>
                                </div>

                                <div class="flex items-center text-sm">
                                    <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">
                                        {{ ucfirst($user->role ?? 'Customer') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Statistik</h3>

                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                        </svg>
                                    </div>
                                    <span class="ml-3 text-gray-700 font-semibold">Total Pesanan</span>
                                </div>
                                <span class="text-2xl font-bold text-blue-600">{{ $totalOrders }}</span>
                            </div>

                            <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <span class="ml-3 text-gray-700 font-semibold">Completed</span>
                                </div>
                                <span class="text-2xl font-bold text-green-600">{{ $completedOrders }}</span>
                            </div>

                            <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                            </path>
                                        </svg>
                                    </div>
                                    <span class="ml-3 text-gray-700 font-semibold">Wishlist</span>
                                </div>
                                <span class="text-2xl font-bold text-purple-600">{{ $wishlistCount }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Badges Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Lencana</h3>

                        <div class="grid grid-cols-3 gap-3">
                            <div class="text-center p-3 bg-yellow-50 rounded-lg">
                                <div class="text-3xl mb-1">🏆</div>
                                <p class="text-xs text-gray-600">Top Buyer</p>
                            </div>
                            <div class="text-center p-3 bg-blue-50 rounded-lg">
                                <div class="text-3xl mb-1">⭐</div>
                                <p class="text-xs text-gray-600">Verified</p>
                            </div>
                            <div class="text-center p-3 bg-green-50 rounded-lg">
                                <div class="text-3xl mb-1">💎</div>
                                <p class="text-xs text-gray-600">Premium</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Activity Timeline -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Aktivitas Terbaru
                        </h3>

                        <div class="space-y-6">
                            @forelse($activities as $activity)
                                <div class="flex items-start space-x-4">
                                    <div class="shrink-0">
                                        <div
                                            class="w-12 h-12 rounded-full bg-linear-to-br {{ $activity->color ?? 'from-blue-500 to-purple-500' }} flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-gray-800 font-semibold">{{ $activity->title }}</p>
                                        <p class="text-gray-600 text-sm mt-1">{{ $activity->description }}</p>
                                        <p class="text-gray-400 text-xs mt-2">{{ $activity->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    <p class="text-gray-500">Belum ada aktivitas</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Recent Orders -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-gray-800 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                                Pesanan Terbaru
                            </h3>
                            <a href="#"
                                class="text-blue-600 hover:text-blue-800 text-sm font-semibold">
                                Lihat Semua →
                            </a>
                            {{--  Bagian Order Link --}}
                        </div>

                        <div class="space-y-4">
                            @forelse($recentOrders as $order)
                                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                                    <div class="flex items-center justify-between mb-3">
                                        <div>
                                            <p class="font-semibold text-gray-800">Order #{{ $order->id }}</p>
                                            <p class="text-sm text-gray-500">
                                                {{ $order->created_at->format('d M Y, H:i') }}</p>
                                        </div>
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold
                                    @if ($order->status == 'completed') bg-green-100 text-green-800
                                    @elseif($order->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                                    @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <p class="text-gray-600 text-sm">{{ $order->items_count }} item</p>
                                        <p class="text-lg font-bold text-blue-600">Rp
                                            {{ number_format($order->total, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    <p class="text-gray-500 mb-2">Belum ada pesanan</p>
                                    <a href="{{ route('products.index') }}"
                                        class="text-blue-600 hover:text-blue-800 text-sm font-semibold">
                                        Mulai Belanja →
                                    </a>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Reviews -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                </path>
                            </svg>
                            Rating & Ulasan
                        </h3>

                        <div class="flex items-center space-x-8 mb-6">
                            <div class="text-center">
                                <div class="text-5xl font-bold text-gray-800">4.8</div>
                                <div class="flex items-center justify-center mt-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= 4 ? 'text-yellow-400' : 'text-gray-300' }}"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                    @endfor
                                </div>
                                <p class="text-sm text-gray-500 mt-1">{{ $reviewsCount }} ulasan</p>
                            </div>

                            <div class="flex-1 space-y-2">
                                @foreach ([5, 4, 3, 2, 1] as $star)
                                    <div class="flex items-center space-x-2">
                                        <span class="text-sm text-gray-600 w-8">{{ $star }}★</span>
                                        <div class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
                                            <div class="h-full bg-yellow-400 rounded-full"
                                                style="width: {{ rand(40, 90) }}%"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
