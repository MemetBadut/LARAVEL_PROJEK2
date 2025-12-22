@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Checkout</h2>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h5 class="text-xl font-bold text-gray-800 mb-6">Informasi Pengiriman</h5>

                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="nama" class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
                            <input type="text" id="nama" name="nama" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                            <input type="email" id="email" name="email" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div class="mb-4">
                            <label for="telepon" class="block text-gray-700 font-semibold mb-2">Nomor Telepon</label>
                            <input type="text" id="telepon" name="telepon" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div class="mb-4">
                            <label for="alamat" class="block text-gray-700 font-semibold mb-2">Alamat Lengkap</label>
                            <textarea id="alamat" name="alamat" rows="3" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label for="kota" class="block text-gray-700 font-semibold mb-2">Kota</label>
                                <input type="text" id="kota" name="kota" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <div>
                                <label for="kode_pos" class="block text-gray-700 font-semibold mb-2">Kode Pos</label>
                                <input type="text" id="kode_pos" name="kode_pos" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition font-semibold">
                            Proses Pesanan
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h5 class="text-xl font-bold text-gray-800 mb-4">Ringkasan Pesanan</h5>
                    <hr class="mb-4">
                    @php $total = 0; @endphp
                    @foreach (session('cart') as $item)
                        @php $total += $item['harga'] * $item['quantity']; @endphp
                        <div class="flex justify-between mb-3 text-sm">
                            <span class="text-gray-600">{{ $item['nama'] }} ({{ $item['quantity'] }}x)</span>
                            <span class="text-gray-900 font-semibold">Rp
                                {{ number_format($item['harga'] * $item['quantity'], 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                    <hr class="my-4">
                    <div class="flex justify-between">
                        <strong class="text-lg text-gray-800">Total:</strong>
                        <strong class="text-2xl text-blue-600">Rp {{ number_format($total, 0, ',', '.') }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
