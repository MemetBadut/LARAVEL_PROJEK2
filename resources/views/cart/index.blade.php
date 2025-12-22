@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Keranjang Belanja</h2>

        @if (session('cart') && count(session('cart')) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produk</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php $total = 0; @endphp
                                @foreach (session('cart') as $id => $item)
                                    @php
                                        $subtotal = $item['harga'] * $item['quantity'];
                                        $total += $subtotal;
                                    @endphp
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $item['nama'] }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">Rp
                                            {{ number_format($item['harga'], 0, ',', '.') }}</td>
                                        <td class="px-6 py-4">
                                            <input type="number" value="{{ $item['quantity'] }}" min="1"
                                                class="w-20 px-2 py-1 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500">
                                        </td>
                                        <td class="px-6 py-4 text-sm font-semibold text-gray-900">Rp
                                            {{ number_format($subtotal, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4">
                                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm transition">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                        <h5 class="text-xl font-bold text-gray-800 mb-4">Ringkasan Belanja</h5>
                        <hr class="mb-4">
                        <div class="flex justify-between mb-4">
                            <span class="text-gray-600">Total:</span>
                            <strong class="text-2xl text-gray-900">Rp {{ number_format($total, 0, ',', '.') }}</strong>
                        </div>
                        <a href="{{ route('checkout.index') }}"
                            class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center px-6 py-3 rounded-lg transition font-semibold">
                            Checkout
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 text-center">
                <p class="text-blue-800 text-lg">Keranjang belanja kosong. <a href="{{ route('products.index') }}"
                        class="font-semibold underline">Belanja sekarang</a></p>
            </div>
        @endif
    </div>
@endsection
