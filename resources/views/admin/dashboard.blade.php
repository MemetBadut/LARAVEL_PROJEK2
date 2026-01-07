@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Dashboard Admin</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-linear-to-r from-blue-500 to-blue-600 text-white rounded-lg shadow-lg p-6">
                <h5 class="text-lg font-semibold mb-2">Total Produk</h5>
                <h2 class="text-4xl font-bold">{{ $totalProduk }}</h2>
            </div>

            <div class="bg-linear-to-r from-green-500 to-green-600 text-white rounded-lg shadow-lg p-6">
                <h5 class="text-lg font-semibold mb-2">Total Penjualan</h5>
                <h2 class="text-4xl font-bold">{{ $totalPenjualan ?? '-' }}</h2>
            </div>

            <div class="bg-linear-to-r from-yellow-500 to-yellow-600 text-white rounded-lg shadow-lg p-6">
                <h5 class="text-lg font-semibold mb-2">Pending Orders</h5>
                <h2 class="text-4xl font-bold">{{ $pendingOrders ?? '-' }}</h2>
            </div>

            <div class="bg-linear-to-r from-purple-500 to-purple-600 text-white rounded-lg shadow-lg p-6">
                <h5 class="text-lg font-semibold mb-2">Total Customer</h5>
                <h2 class="text-4xl font-bold">{{ $totalCustomer ?? '-' }}</h2>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b">
                <h5 class="text-xl font-bold text-gray-800">Produk Terbaru</h5>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stok</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($latestProduks as $produk)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $produk->nama_produk }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">Rp
                                    {{ number_format($produk->harga_produk, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $produk->stok_produk }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $produk->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $latestProduks->links() }}
@endsection
