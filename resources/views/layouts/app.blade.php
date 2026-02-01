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
                <div class="group relative">
                    <a href="{{ url('/') }}" class="text-2xl font-bold">
                        {{ config('app.name', 'Toko Online') }}
                    </a>
                    <span
                        class="absolute top-full left-1/2 -translate-x-1/2 mt-2
                             bg-gray-900 text-white text-xs font-medium px-3 py-1.5 rounded-md shadow-xl whitespace-nowrap
                             opacity-0 group-hover:opacity-100 scale-95 group-hover:scale-100
                             transition-all duration-200 pointer-events-none z-50">
                        🏠 Halaman Utama
                        <span class="absolute -top-1 left-1/2 -translate-x-1/2 w-2 h-2 bg-gray-900 rotate-45"></span>
                    </span>
                </div>


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
                            {{-- Admin Home --}}
                            <div class="group relative">
                                <a href="{{ route('admin.adminHome') }}" class="hover:text-blue-200 transition">
                                    Home
                                </a>
                                <span
                                    class="absolute top-full left-1/2 -translate-x-1/2 mt-2
                             bg-gray-900 text-white text-xs font-medium px-3 py-1.5 rounded-md shadow-xl whitespace-nowrap
                             opacity-0 group-hover:opacity-100 scale-95 group-hover:scale-100
                             transition-all duration-200 pointer-events-none z-50">
                                    🏠 Halaman Utama
                                    <span
                                        class="absolute -top-1 left-1/2 -translate-x-1/2 w-2 h-2 bg-gray-900 rotate-45"></span>
                                </span>
                            </div>

                            {{-- Admin Dashboard --}}
                            <div class="group relative">
                                <a href="{{ route('admin.adminDashboard') }}" class="hover:text-blue-200 transition">
                                    Dashboard
                                </a>
                                <span
                                    class="absolute top-full left-1/2 -translate-x-1/2 mt-2
                             bg-gray-900 text-white text-xs font-medium px-3 py-1.5 rounded-md shadow-xl whitespace-nowrap
                             opacity-0 group-hover:opacity-100 scale-95 group-hover:scale-100
                             transition-all duration-200 pointer-events-none z-50">
                                    📊 Dashboard Admin
                                    <span
                                        class="absolute -top-1 left-1/2 -translate-x-1/2 w-2 h-2 bg-gray-900 rotate-45"></span>
                                </span>
                            </div>

                            {{-- Kelola Produk --}}
                            <div class="group relative">
                                <a href="{{ route('admin.products.index') }}" class="hover:text-blue-200 transition">
                                    Kelola Produk
                                </a>
                                <span
                                    class="absolute top-full left-1/2 -translate-x-1/2 mt-2
                             bg-gray-900 text-white text-xs font-medium px-3 py-1.5 rounded-md shadow-xl whitespace-nowrap
                             opacity-0 group-hover:opacity-100 scale-95 group-hover:scale-100
                             transition-all duration-200 pointer-events-none z-50">
                                    📦 Manajemen Produk
                                    <span
                                        class="absolute -top-1 left-1/2 -translate-x-1/2 w-2 h-2 bg-gray-900 rotate-45"></span>
                                </span>
                            </div>
                        @endif

                        @if (auth()->user()->role == 'vendor')
                            {{-- Vendor Home --}}
                            <div class="group relative">
                                <a href="{{ route('vendor.vendorHome') }}" class="hover:text-blue-200 transition">
                                    Home
                                </a>
                                <span
                                    class="absolute top-full left-1/2 -translate-x-1/2 mt-2
                             bg-gray-900 text-white text-xs font-medium px-3 py-1.5 rounded-md shadow-xl whitespace-nowrap
                             opacity-0 group-hover:opacity-100 scale-95 group-hover:scale-100
                             transition-all duration-200 pointer-events-none z-50">
                                    🏠 Beranda Vendor
                                    <span
                                        class="absolute -top-1 left-1/2 -translate-x-1/2 w-2 h-2 bg-gray-900 rotate-45"></span>
                                </span>
                            </div>

                            {{-- Vendor Dashboard Icon --}}
                            <div class="group relative">
                                <a href="{{ route('vendor.vendorDashboard') }}"
                                    class="hover:text-blue-200 transition block">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                        height="24" fill="currentColor">
                                        <path
                                            d="M22 20V22H2V20H3V13.2422C1.79401 12.435 1 11.0602 1 9.5C1 8.67286 1.22443 7.87621 1.63322 7.19746L4.3453 2.5C4.52393 2.1906 4.85406 2 5.21132 2H18.7887C19.1459 2 19.4761 2.1906 19.6547 2.5L22.3575 7.18172C22.7756 7.87621 23 8.67286 23 9.5C23 11.0602 22.206 12.435 21 13.2422V20H22ZM5.78865 4L3.35598 8.21321C3.12409 8.59843 3 9.0389 3 9.5C3 10.8807 4.11929 12 5.5 12C6.53096 12 7.44467 11.3703 7.82179 10.4295C8.1574 9.59223 9.3426 9.59223 9.67821 10.4295C10.0553 11.3703 10.969 12 12 12C13.031 12 13.9447 11.3703 14.3218 10.4295C14.6574 9.59223 15.8426 9.59223 16.1782 10.4295C16.5553 11.3703 17.469 12 18.5 12C19.8807 12 21 10.8807 21 9.5C21 9.0389 20.8759 8.59843 20.6347 8.19746L18.2113 4H5.78865Z">
                                        </path>
                                    </svg>
                                </a>
                                <div
                                    class="absolute top-full left-1/2 -translate-x-1/2 mt-2
                            opacity-0 group-hover:opacity-100 scale-95 group-hover:scale-100
                            transition-all duration-200 pointer-events-none z-50">
                                    <div
                                        class="bg-gray-900 text-white text-xs font-medium px-3 py-1.5 rounded-md shadow-xl whitespace-nowrap">
                                        🏪 Produk Vendor
                                        <div
                                            class="absolute -top-1 left-1/2 -translate-x-1/2 w-2 h-2 bg-gray-900 rotate-45">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endauth

                    {{-- Cart --}}
                    <div class="group relative">
                        <a href="{{ route('cart.index') }}"
                            class="flex items-center hover:text-blue-200 transition relative">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                fill="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.00436 6.41686L0.761719 3.17422L2.17593 1.76001L5.41857 5.00265H20.6603C21.2126 5.00265 21.6603 5.45037 21.6603 6.00265C21.6603 6.09997 21.6461 6.19678 21.6182 6.29L19.2182 14.29C19.0913 14.713 18.7019 15.0027 18.2603 15.0027H6.00436V17.0027H17.0044V19.0027H5.00436C4.45207 19.0027 4.00436 18.5549 4.00436 18.0027V6.41686ZM5.50436 23.0027C4.67593 23.0027 4.00436 22.3311 4.00436 21.5027C4.00436 20.6742 4.67593 20.0027 5.50436 20.0027C6.33279 20.0027 7.00436 20.6742 7.00436 21.5027C7.00436 22.3311 6.33279 23.0027 5.50436 23.0027ZM17.5044 23.0027C16.6759 23.0027 16.0044 22.3311 16.0044 21.5027C16.0044 20.6742 16.6759 20.0027 17.5044 20.0027C18.3328 20.0027 19.0044 20.6742 19.0044 21.5027C19.0044 22.3311 18.3328 23.0027 17.5044 23.0027Z">
                                </path>
                            </svg>
                            @if (session('cart'))
                                <span
                                    class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                    {{ count(session('cart')) }}
                                </span>
                            @endif
                        </a>
                        <span
                            class="absolute top-full left-1/2 -translate-x-1/2 mt-2
                     bg-gray-900 text-white text-xs font-medium px-3 py-1.5 rounded-md shadow-xl whitespace-nowrap
                     opacity-0 group-hover:opacity-100 scale-95 group-hover:scale-100
                     transition-all duration-200 pointer-events-none z-50">
                            🛒 Keranjang Belanja
                            <span
                                class="absolute -top-1 left-1/2 -translate-x-1/2 w-2 h-2 bg-gray-900 rotate-45"></span>
                        </span>
                    </div>

                    @guest
                        {{-- Login --}}
                        <div class="group relative">
                            <a href="{{ route('login') }}" class="hover:text-blue-200 transition">Login</a>
                            <span
                                class="absolute top-full left-1/2 -translate-x-1/2 mt-2
                         bg-gray-900 text-white text-xs font-medium px-3 py-1.5 rounded-md shadow-xl whitespace-nowrap
                         opacity-0 group-hover:opacity-100 scale-95 group-hover:scale-100
                         transition-all duration-200 pointer-events-none z-50">
                                🔑 Masuk ke Akun
                                <span
                                    class="absolute -top-1 left-1/2 -translate-x-1/2 w-2 h-2 bg-gray-900 rotate-45"></span>
                            </span>
                        </div>

                        {{-- Register --}}
                        <div class="group relative">
                            <a href="{{ route('register') }}"
                                class="bg-white text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50 transition">Register</a>
                            <span
                                class="absolute top-full left-1/2 -translate-x-1/2 mt-2
                         bg-gray-900 text-white text-xs font-medium px-3 py-1.5 rounded-md shadow-xl whitespace-nowrap
                         opacity-0 group-hover:opacity-100 scale-95 group-hover:scale-100
                         transition-all duration-200 pointer-events-none z-50">
                                ✨ Daftar Akun Baru
                                <span
                                    class="absolute -top-1 left-1/2 -translate-x-1/2 w-2 h-2 bg-gray-900 rotate-45"></span>
                            </span>
                        </div>
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
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
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
