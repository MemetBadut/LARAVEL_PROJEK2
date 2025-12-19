<aside :class="sidebarOpen ? 'w-64' : 'w-20'"
    class="fixed left-0 top-0 h-screen bg-linear-to-b from-indigo-600 to-indigo-800 text-white transition-all duration-300 shadow-xl overflow-y-auto z-40">
    <div class="p-6">
        <div class="flex items-center justify-between mb-8">
            <h1 x-show="sidebarOpen" class="text-2xl font-bold" x-transition>
                <i class="fas fa-store mr-2"></i>MarketPlace
            </h1>
            <i x-show="!sidebarOpen" class="fas fa-store text-2xl" x-transition></i>
            <button @click="sidebarOpen = !sidebarOpen" class="hover:bg-indigo-700 p-2 rounded">
                <i :class="sidebarOpen ? 'fa-angles-left' : 'fa-angles-right'" class="fas"></i>
            </button>
        </div>

        <nav class="space-y-2">
            <a href="#" @click="currentTab = 'dashboard'"
                :class="currentTab === 'dashboard' ? 'bg-indigo-700 shadow-lg' : 'hover:bg-indigo-700'"
                class="flex items-center py-3 px-4 rounded-lg transition-all">
                <i class="fas fa-home w-6"></i>
                <span x-show="sidebarOpen" class="ml-3" x-transition>Dashboard</span>
            </a>
            <a href="#" @click="currentTab = 'products'"
                :class="currentTab === 'products' ? 'bg-indigo-700 shadow-lg' : 'hover:bg-indigo-700'"
                class="flex items-center py-3 px-4 rounded-lg transition-all">
                <i class="fas fa-box w-6"></i>
                <span x-show="sidebarOpen" class="ml-3" x-transition>Produk</span>
            </a>
            <a href="#" @click="currentTab = 'orders'"
                :class="currentTab === 'orders' ? 'bg-indigo-700 shadow-lg' : 'hover:bg-indigo-700'"
                class="flex items-center py-3 px-4 rounded-lg transition-all">
                <i class="fas fa-shopping-cart w-6"></i>
                <span x-show="sidebarOpen" class="ml-3" x-transition>Pesanan</span>
                <span x-show="sidebarOpen" class="ml-auto bg-red-500 text-xs px-2 py-1 rounded-full"
                    x-transition>12</span>
            </a>
            <a href="#" @click="currentTab = 'customers'"
                :class="currentTab === 'customers' ? 'bg-indigo-700 shadow-lg' : 'hover:bg-indigo-700'"
                class="flex items-center py-3 px-4 rounded-lg transition-all">
                <i class="fas fa-users w-6"></i>
                <span x-show="sidebarOpen" class="ml-3" x-transition>Pelanggan</span>
            </a>
            <a href="#" @click="currentTab = 'reports'"
                :class="currentTab === 'reports' ? 'bg-indigo-700 shadow-lg' : 'hover:bg-indigo-700'"
                class="flex items-center py-3 px-4 rounded-lg transition-all">
                <i class="fas fa-chart-line w-6"></i>
                <span x-show="sidebarOpen" class="ml-3" x-transition>Laporan</span>
            </a>
            <a href="#" class="flex items-center py-3 px-4 rounded-lg hover:bg-indigo-700 transition-all">
                <i class="fas fa-cog w-6"></i>
                <span x-show="sidebarOpen" class="ml-3" x-transition>Pengaturan</span>
            </a>
        </nav>
    </div>
</aside>
