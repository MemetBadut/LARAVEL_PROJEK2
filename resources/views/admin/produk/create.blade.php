@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white rounded-xl border border-gray-200 shadow-lg p-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Tambah Produk Baru</h2>

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Produk <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nama" name="nama_produk" value="{{ old('nama_produk') }}" required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nama_produk') border-red-500 @enderror">
                    @error('nama_produk')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="kategori" class="block text-sm font-semibold text-gray-700 mb-2">
                        Kategori Produk <span class="text-red-500">*</span>
                    </label>
                    <select id="kategori" name="kategori_produk" required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('kategori_produk') border-red-500 @enderror">
                        <option value="">Pilih Kategori</option>
                        <optgroup label="Electronics">
                            <option value="smartphone" {{ old('kategori_produk') == 'smartphone' ? 'selected' : '' }}>📱
                                Smartphone</option>
                            <option value="laptop" {{ old('kategori_produk') == 'laptop' ? 'selected' : '' }}>💻 Laptop
                            </option>
                            <option value="tablet" {{ old('kategori_produk') == 'tablet' ? 'selected' : '' }}>📲 Tablet
                            </option>
                            <option value="audio" {{ old('kategori_produk') == 'audio' ? 'selected' : '' }}>🎧 Audio &
                                Headphones</option>
                            <option value="camera" {{ old('kategori_produk') == 'camera' ? 'selected' : '' }}>📷 Camera
                            </option>
                            <option value="gaming" {{ old('kategori_produk') == 'gaming' ? 'selected' : '' }}>🎮 Gaming
                            </option>
                        </optgroup>
                        <optgroup label="Fashion">
                            <option value="pakaian-pria" {{ old('kategori_produk') == 'pakaian-pria' ? 'selected' : '' }}>👔
                                Pakaian Pria</option>
                            <option value="pakaian-wanita"
                                {{ old('kategori_produk') == 'pakaian-wanita' ? 'selected' : '' }}>👗 Pakaian Wanita
                            </option>
                            <option value="sepatu" {{ old('kategori_produk') == 'sepatu' ? 'selected' : '' }}>👟 Sepatu
                            </option>
                            <option value="tas" {{ old('kategori_produk') == 'tas' ? 'selected' : '' }}>👜 Tas & Dompet
                            </option>
                            <option value="aksesoris" {{ old('kategori_produk') == 'aksesoris' ? 'selected' : '' }}>💍
                                Aksesoris</option>
                            <option value="jam-tangan" {{ old('kategori_produk') == 'jam-tangan' ? 'selected' : '' }}>⌚ Jam
                                Tangan</option>
                        </optgroup>
                        <optgroup label="Food & Beverage">
                            <option value="makanan-ringan"
                                {{ old('kategori_produk') == 'makanan-ringan' ? 'selected' : '' }}>🍿 Makanan Ringan
                            </option>
                            <option value="minuman" {{ old('kategori_produk') == 'minuman' ? 'selected' : '' }}>🥤 Minuman
                            </option>
                            <option value="makanan-beku" {{ old('kategori_produk') == 'makanan-beku' ? 'selected' : '' }}>
                                🧊 Makanan Beku</option>
                            <option value="bumbu-masak" {{ old('kategori_produk') == 'bumbu-masak' ? 'selected' : '' }}>🧂
                                Bumbu & Masak</option>
                        </optgroup>
                        <optgroup label="Home & Living">
                            <option value="furniture" {{ old('kategori_produk') == 'furniture' ? 'selected' : '' }}>🛋️
                                Furniture</option>
                            <option value="dekorasi" {{ old('kategori_produk') == 'dekorasi' ? 'selected' : '' }}>🖼️
                                Dekorasi</option>
                            <option value="peralatan-dapur"
                                {{ old('kategori_produk') == 'peralatan-dapur' ? 'selected' : '' }}>🍳 Peralatan Dapur
                            </option>
                            <option value="perlengkapan-rumah"
                                {{ old('kategori_produk') == 'perlengkapan-rumah' ? 'selected' : '' }}>🏠 Perlengkapan
                                Rumah</option>
                        </optgroup>
                        <optgroup label="Sports & Outdoor">
                            <option value="olahraga" {{ old('kategori_produk') == 'olahraga' ? 'selected' : '' }}>⚽
                                Peralatan Olahraga</option>
                            <option value="outdoor" {{ old('kategori_produk') == 'outdoor' ? 'selected' : '' }}>🏕️ Outdoor
                                & Camping</option>
                            <option value="fitness" {{ old('kategori_produk') == 'fitness' ? 'selected' : '' }}>💪 Fitness
                            </option>
                        </optgroup>
                        <optgroup label="Health & Beauty">
                            <option value="skincare" {{ old('kategori_produk') == 'skincare' ? 'selected' : '' }}>🧴
                                Skincare</option>
                            <option value="makeup" {{ old('kategori_produk') == 'makeup' ? 'selected' : '' }}>💄 Makeup
                            </option>
                            <option value="kesehatan" {{ old('kategori_produk') == 'kesehatan' ? 'selected' : '' }}>⚕️
                                Kesehatan</option>
                            <option value="suplemen" {{ old('kategori_produk') == 'suplemen' ? 'selected' : '' }}>💊
                                Suplemen</option>
                        </optgroup>
                        <optgroup label="Books & Media">
                            <option value="buku" {{ old('kategori_produk') == 'buku' ? 'selected' : '' }}>📚 Buku
                            </option>
                            <option value="alat-tulis" {{ old('kategori_produk') == 'alat-tulis' ? 'selected' : '' }}>✏️
                                Alat Tulis</option>
                            <option value="hobi" {{ old('kategori_produk') == 'hobi' ? 'selected' : '' }}>🎨 Hobi &
                                Koleksi</option>
                        </optgroup>
                        <optgroup label="Toys & Kids">
                            <option value="mainan" {{ old('kategori_produk') == 'mainan' ? 'selected' : '' }}>🧸 Mainan
                            </option>
                            <option value="perlengkapan-bayi"
                                {{ old('kategori_produk') == 'perlengkapan-bayi' ? 'selected' : '' }}>🍼 Perlengkapan Bayi
                            </option>
                            <option value="pakaian-anak" {{ old('kategori_produk') == 'pakaian-anak' ? 'selected' : '' }}>
                                👶 Pakaian Anak</option>
                        </optgroup>
                        <optgroup label="Automotive">
                            <option value="otomotif" {{ old('kategori_produk') == 'otomotif' ? 'selected' : '' }}>🚗
                                Otomotif</option>
                            <option value="aksesoris-mobil"
                                {{ old('kategori_produk') == 'aksesoris-mobil' ? 'selected' : '' }}>🔧 Aksesoris Mobil
                            </option>
                        </optgroup>
                        <option value="lainnya" {{ old('kategori_produk') == 'lainnya' ? 'selected' : '' }}>📦 Lainnya
                        </option>
                    </select>
                    @error('kategori_produk')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="harga" class="block text-sm font-semibold text-gray-700 mb-2">
                            Harga <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-semibold">Rp</span>
                            <input type="number" id="harga" name="harga_produk" value="{{ old('harga_produk') }}"
                                required min="0"
                                class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('harga_produk') border-red-500 @enderror">
                        </div>
                        @error('harga_produk')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="stok" class="block text-sm font-semibold text-gray-700 mb-2">
                            Stok <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="stok" name="stok_produk" value="{{ old('stok_produk') }}" required
                            min="0"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('stok_produk') border-red-500 @enderror">
                        @error('stok_produk')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <textarea id="deskripsi" name="deskripsi_produk" rows="4"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('deskripsi_produk') border-red-500 @enderror">{{ old('deskripsi_produk') }}</textarea>
                    @error('deskripsi_produk')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="gambar" class="block text-sm font-semibold text-gray-700 mb-2">
                        Gambar Produk
                    </label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-500 transition cursor-pointer"
                        onclick="document.getElementById('gambar').click()">
                        <input type="file" id="gambar" name="gambar" accept="image/*"
                            onchange="previewImage(event)" class="hidden"
                            class="@error('gambar') border-red-500 @enderror">
                        <svg class="w-12 h-12 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                            </path>
                        </svg>
                        <p class="text-sm text-gray-600 font-semibold">Click to upload image</p>
                        <p class="text-xs text-gray-500 mt-1">PNG, JPG, JPEG (Max 2MB)</p>
                    </div>

                    {{-- Image Preview --}}
                    <div id="image-preview" class="mt-4 hidden">
                        <p class="text-sm font-semibold text-gray-700 mb-2">Preview:</p>
                        <img id="preview" class="w-48 h-48 object-cover rounded-lg border border-gray-200 shadow">
                    </div>

                    @error('gambar')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex space-x-4">
                    <button type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition font-bold shadow-lg">
                        Simpan Produk
                    </button>
                    <a href="{{ route('admin.products.index') }}"
                        class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition font-bold">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const previewDiv = document.getElementById('image-preview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewDiv.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
