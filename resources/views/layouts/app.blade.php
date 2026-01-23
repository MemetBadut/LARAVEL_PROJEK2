<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Toko Online') }} - @yield('title', 'Home')</title>

    <!-- Tailwind CSS v4 -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @layer base {
            body {
                @apply min-h-screen flex flex-col;
            }
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a href="{{ url('/') }}" class="text-2xl font-bold">
                    {{ config('app.name', 'Toko Online') }}
                </a>

                <!-- Mobile menu button -->
                <button class="md:hidden" onclick="toggleMenu()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-6">
                    @auth
                        @if (auth()->user()->role == 'admin')
                            <a href="{{ route('admin.adminHome') }}" class="hover:text-blue-200 transition">
                                Home
                            </a>
                            <a href="{{ route('products.index') }}" class="hover:text-blue-200 transition">Produk</a>
                            <a href="{{ route('admin.adminDashboard') }}"
                                class="hover:text-blue-200 transition">Dashboard</a>

                            <a href="{{ route('admin.products.index') }}" class="hover:text-blue-200 transition">Kelola
                                Produk</a>
                        @endif
                        @if (auth()->user()->role == 'vendor')
                            <a href="{{ route('vendor.vendorDashboard') }}" class="hover:text-blue-200 transition">Produk
                                Saya</a>
                        @endif
                    @endauth

                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}"
                        class="flex items-center hover:text-blue-200 transition relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                        @if (session('cart'))
                            <span
                                class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                {{ count(session('cart')) }}
                            </span>
                        @endif
                    </a>

                    @guest
                        <a href="{{ route('login') }}" class="hover:text-blue-200 transition">Login</a>
                        <a href="{{ route('register') }}"
                            class="bg-white text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50 transition">Register</a>
                    @else
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="flex items-center space-x-2 hover:text-blue-200 transition">
                                <span>{{ auth()->user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50">
                                <a href="{{ route('profile.index') }}"
                                    class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profile</a>
                                <a href="{{ route('orders.index') }}"
                                    class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Pesanan Saya</a>
                                <hr class="my-2">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">Logout</button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden pb-4">
                <div class="flex flex-col space-y-2">
                    <a href="{{ url('/') }}" class="hover:text-blue-200 transition">Home</a>
                    <a href="{{ route('products.index') }}" class="hover:text-blue-200 transition">Produk</a>
                    @guest
                        <a href="{{ route('login') }}" class="hover:text-blue-200 transition">Login</a>
                        <a href="{{ route('register') }}" class="hover:text-blue-200 transition">Register</a>
                    @else
                        <a href="{{ route('profile.index') }}" class="hover:text-blue-200 transition">Profile</a>
                        <a href="#" class="hover:text-blue-200 transition">Pesanan Saya</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-left hover:text-blue-200 transition">Logout</button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Alert Messages -->
    @if (session('success'))
        <div class="container mx-auto px-4 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="container mx-auto px-4 mt-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
                <button onclick="this.parentElement.remove()" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    @if (session('warning'))
        <div class="container mx-auto px-4 mt-4">
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative"
                role="alert">
                <span class="block sm:inline">{{ session('warning') }}</span>
                <button onclick="this.parentElement.remove()" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-yellow-500" role="button"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-1 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-auto">
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h5 class="text-xl font-bold mb-4">{{ config('app.name', 'Toko Online') }}</h5>
                    <p class="text-gray-400">Belanja online mudah dan terpercaya</p>
                </div>
                <div>
                    <h5 class="text-xl font-bold mb-4">Link Cepat</h5>
                    <ul class="space-y-2">
                        <li><a href="{{ url('/') }}" class="text-gray-400 hover:text-white transition">Home</a>
                        </li>
                        <li><a href="{{ route('products.index') }}"
                                class="text-gray-400 hover:text-white transition">Produk</a></li>
                        <li><a href="{{ url('/about') }}" class="text-gray-400 hover:text-white transition">Tentang
                                Kami</a></li>
                        <li><a href="{{ url('/contact') }}"
                                class="text-gray-400 hover:text-white transition">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-xl font-bold mb-4">Hubungi Kami</h5>
                    <p class="text-gray-400">
                        Email: info@tokoonline.com<br>
                        Telepon: 0812-3456-7890<br>
                        Alamat: Jakarta, Indonesia
                    </p>
                </div>
            </div>
            <hr class="my-8 border-gray-700">
            <div class="text-center text-gray-400">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'Toko Online') }}. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Alpine.js for dropdown -->
    <script>
        function toggleMenu() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        }
    </script>

    @stack('scripts')
</body>

</html>
