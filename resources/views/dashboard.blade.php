<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Marketplace</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100" x-data="{
    sidebarOpen: true,
    showNotif: false,
    showProfile: false,
    currentTab: 'dashboard',
    notifications: [
        { text: 'Pesanan baru dari John Doe', time: '5 menit lalu', unread: true },
        { text: 'Produk hampir habis: Headphone', time: '1 jam lalu', unread: true },
        { text: 'Pembayaran berhasil #1234', time: '2 jam lalu', unread: false }
    ],
    stats: [
        { title: 'Total Penjualan', value: 'Rp 45.2M', change: '+12.5%', icon: 'fa-sack-dollar', color: 'indigo', up: true },
        { title: 'Total Pesanan', value: '1,423', change: '+8.2%', icon: 'fa-shopping-cart', color: 'green', up: true },
        { title: 'Total Produk', value: '284', change: '0%', icon: 'fa-box', color: 'blue', up: null },
        { title: 'Total Pelanggan', value: '892', change: '+15.3%', icon: 'fa-users', color: 'purple', up: true }
    ],
    orders: [
        { id: '#001', customer: 'John Doe', total: 'Rp 125.000', status: 'Diproses', statusColor: 'yellow' },
        { id: '#002', customer: 'Jane Smith', total: 'Rp 89.000', status: 'Selesai', statusColor: 'green' },
        { id: '#003', customer: 'Bob Wilson', total: 'Rp 245.000', status: 'Dikirim', statusColor: 'blue' },
        { id: '#004', customer: 'Sarah Lee', total: 'Rp 156.000', status: 'Diproses', statusColor: 'yellow' }
    ],
    products: [
        { name: 'Headphone Wireless', sold: 245, price: 'Rp 599K', stock: 12 },
        { name: 'Smart Watch Pro', sold: 189, price: 'Rp 1.2M', stock: 8 },
        { name: 'Sunglasses Classic', sold: 156, price: 'Rp 299K', stock: 25 },
        { name: 'Leather Backpack', sold: 134, price: 'Rp 450K', stock: 15 }
    ],
    chartData: [60, 80, 45, 90, 70, 100, 55]
}">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <x-sidebar></x-sidebar>

        <!-- Main Content -->
        <main :class="sidebarOpen ? 'ml-64' : 'ml-20'" class="flex-1 transition-all duration-300">
            <!-- Header -->
            <header class="bg-white shadow-sm sticky top-0 z-10">
                <div class="flex items-center justify-between p-6">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800">
                            <i class="fas fa-chart-pie text-indigo-600 mr-2"></i>Dashboard
                        </h2>
                        <p class="text-gray-600 mt-1">
                            <i class="far fa-calendar-alt mr-2"></i>Selamat datang kembali, Admin!
                        </p>
                    </div>

                    <div class="flex items-center gap-4">
                        <!-- Search -->
                        <div class="relative hidden md:block">
                            <i
                                class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="text" placeholder="Cari..."
                                class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <!-- Notifications -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="relative p-2 hover:bg-gray-100 rounded-lg transition">
                                <i class="fas fa-bell text-gray-600 text-xl"></i>
                                <span
                                    class="absolute top-0 right-0 w-3 h-3 bg-red-500 rounded-full animate-pulse"></span>
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition
                                class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl border z-50">
                                <div class="p-4 border-b">
                                    <h3 class="font-bold text-gray-800">
                                        <i class="fas fa-bell mr-2"></i>Notifikasi
                                    </h3>
                                </div>
                                <div class="max-h-96 overflow-y-auto">
                                    <template x-for="notif in notifications" :key="notif.text">
                                        <div class="p-4 hover:bg-gray-50 border-b cursor-pointer transition"
                                            :class="notif.unread ? 'bg-blue-50' : ''">
                                            <p class="text-sm text-gray-800" x-text="notif.text"></p>
                                            <p class="text-xs text-gray-500 mt-1">
                                                <i class="far fa-clock mr-1"></i><span x-text="notif.time"></span>
                                            </p>
                                        </div>
                                    </template>
                                </div>
                                <div class="p-3 text-center border-t">
                                    <a href="#" class="text-sm text-indigo-600 hover:text-indigo-700">Lihat
                                        semua</a>
                                </div>
                            </div>
                        </div>

                        <!-- Profile -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="flex items-center gap-3 hover:bg-gray-100 p-2 rounded-lg transition">
                                <div class="text-right hidden md:block">
                                    <p class="text-sm font-medium text-gray-800">Admin User</p>
                                    <p class="text-xs text-gray-500">admin@example.com</p>
                                </div>
                                <div
                                    class="w-10 h-10 bg-linear-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                                    AU
                                </div>
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition
                                class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border z-50">
                                <a href="#" class="block px-4 py-3 hover:bg-gray-50 transition">
                                    <i class="fas fa-user mr-2"></i>Profil
                                </a>
                                <a href="#" class="block px-4 py-3 hover:bg-gray-50 transition">
                                    <i class="fas fa-cog mr-2"></i>Pengaturan
                                </a>
                                <a href="#"
                                    class="block px-4 py-3 hover:bg-gray-50 transition border-t text-red-600">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="p-8">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <template x-for="(stat, index) in stats" :key="index">
                        <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-lg transition-all transform hover:-translate-y-1 cursor-pointer border-l-4"
                            :class="`border-${stat.color}-500`">
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    :class="`w-12 h-12 bg-${stat.color}-100 rounded-lg flex items-center justify-center`">
                                    <i :class="`fas ${stat.icon} text-${stat.color}-600 text-xl`"></i>
                                </div>
                                <span x-show="stat.up !== null" :class="stat.up ? 'text-green-600' : 'text-red-600'"
                                    class="text-sm font-semibold flex items-center gap-1">
                                    <i :class="stat.up ? 'fa-arrow-up' : 'fa-arrow-down'" class="fas"></i>
                                    <span x-text="stat.change"></span>
                                </span>
                            </div>
                            <p class="text-gray-600 text-sm" x-text="stat.title"></p>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1" x-text="stat.value"></h3>
                        </div>
                    </template>
                </div>

                <!-- Charts and Tables -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Recent Orders -->
                    <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-lg transition-all">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-gray-800">
                                <i class="fas fa-receipt text-indigo-600 mr-2"></i>Pesanan Terbaru
                            </h3>
                            <a href="#" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                                Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                        <div class="space-y-3">
                            <template x-for="order in orders" :key="order.id">
                                <div
                                    class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition cursor-pointer">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-file-invoice text-indigo-600"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800" x-text="order.customer"></p>
                                            <p class="text-xs text-gray-500" x-text="order.id"></p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold text-gray-800" x-text="order.total"></p>
                                        <span :class="`bg-${order.statusColor}-100 text-${order.statusColor}-700`"
                                            class="inline-block px-2 py-1 text-xs font-medium rounded-full mt-1"
                                            x-text="order.status"></span>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Top Products -->
                    <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-lg transition-all">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-gray-800">
                                <i class="fas fa-trophy text-yellow-500 mr-2"></i>Produk Terlaris
                            </h3>
                            <a href="#" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                                Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                        <div class="space-y-3">
                            <template x-for="(product, index) in products" :key="index">
                                <div
                                    class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition cursor-pointer">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center font-bold text-purple-600"
                                            x-text="`#${index + 1}`"></div>
                                        <div>
                                            <p class="font-medium text-gray-800" x-text="product.name"></p>
                                            <p class="text-xs text-gray-500">
                                                <i class="fas fa-fire text-orange-500 mr-1"></i>
                                                <span x-text="product.sold"></span> terjual
                                            </p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold text-gray-800" x-text="product.price"></p>
                                        <p class="text-xs text-gray-500">
                                            <i class="fas fa-box mr-1"></i>
                                            Stock: <span x-text="product.stock"></span>
                                        </p>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- Sales Chart -->
                <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-lg transition-all">
                    <h3 class="text-lg font-bold text-gray-800 mb-6">
                        <i class="fas fa-chart-bar text-indigo-600 mr-2"></i>Penjualan Mingguan
                    </h3>
                    <div class="flex items-end justify-between h-64 gap-2">
                        <template x-for="(height, index) in chartData" :key="index">
                            <div class="flex-1 flex flex-col items-center group cursor-pointer">
                                <div class="w-full bg-linear-to-t from-indigo-600 to-indigo-400 rounded-t-lg transition-all group-hover:from-indigo-700 group-hover:to-indigo-500 relative"
                                    :style="`height: ${height}%`"
                                    @mouseenter="$el.querySelector('.tooltip').classList.remove('hidden')"
                                    @mouseleave="$el.querySelector('.tooltip').classList.add('hidden')">
                                    <div
                                        class="tooltip hidden absolute bottom-full mb-2 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded whitespace-nowrap">
                                        <span x-text="`Rp ${(height * 1000).toLocaleString()}`"></span>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-600 mt-2 font-medium"
                                    x-text="['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'][index]"></p>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
