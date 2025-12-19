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
                      <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                      <input type="text" placeholder="Cari..."
                          class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                  </div>

                  <!-- Notifications -->
                  <div class="relative" x-data="{ open: false }">
                      <button @click="open = !open" class="relative p-2 hover:bg-gray-100 rounded-lg transition">
                          <i class="fas fa-bell text-gray-600 text-xl"></i>
                          <span class="absolute top-0 right-0 w-3 h-3 bg-red-500 rounded-full animate-pulse"></span>
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
                          <a href="#" class="block px-4 py-3 hover:bg-gray-50 transition border-t text-red-600">
                              <i class="fas fa-sign-out-alt mr-2"></i>Logout
                          </a>
                      </div>
                  </div>
              </div>
          </div>
      </header>
