@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-3xl font-bold text-gray-800">Edit Profile</h2>
                    <a href="{{ route('profile.index') }}" class="text-gray-600 hover:text-gray-800">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </a>
                </div>

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Profile Photo -->
                    <div class="mb-6 text-center">
                        <div
                            class="w-32 h-32 mx-auto rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-5xl font-bold text-white mb-4">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <label class="cursor-pointer text-blue-600 hover:text-blue-800 font-semibold">
                            <input type="file" name="photo" accept="image/*" class="hidden"
                                onchange="previewPhoto(event)">
                            Upload Foto Profile
                        </label>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama
                                Lengkap</label>
                            <input type="text" id="name" name="name"
                                value="{{ old('name', auth()->user()->name) }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" name="email"
                                value="{{ old('email', auth()->user()->email) }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Nomor
                                Telepon</label>
                            <input type="text" id="phone" name="phone"
                                value="{{ old('phone', auth()->user()->phone) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label for="birth_date" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal
                                Lahir</label>
                            <input type="date" id="birth_date" name="birth_date"
                                value="{{ old('birth_date', auth()->user()->birth_date) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label for="gender" class="block text-sm font-semibold text-gray-700 mb-2">Jenis
                                Kelamin</label>
                            <select id="gender" name="gender"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Pilih</option>
                                <option value="male"
                                    {{ old('gender', auth()->user()->gender) == 'male' ? 'selected' : '' }}>Laki-laki
                                </option>
                                <option value="female"
                                    {{ old('gender', auth()->user()->gender) == 'female' ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                        </div>

                        <div>
                            <label for="bio" class="block text-sm font-semibold text-gray-700 mb-2">Bio</label>
                            <textarea id="bio" name="bio" rows="4"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('bio', auth()->user()->bio) }}</textarea>
                        </div>
                    </div>

                    <div class="flex space-x-4 mt-6">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition font-semibold">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('profile.index') }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg transition">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewPhoto(event) {
            // Photo preview logic here
            console.log('Photo selected');
        }
    </script>
@endsection
