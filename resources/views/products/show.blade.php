@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white rounded-lg shadow-md p-6">
            <div>
                @if ($product->gambar)
                    <img src="{{ asset('storage/' . $product->gambar) }}" class="w-full rounded-lg shadow-lg"
                        alt="{{ $product->nama }}">
                @else
                    <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                        <span class="text-gray-400 text-xl">No Image</span>
                    </div>
                @endif
            </div>

            <div>
                <h2 class="text-4xl font-bold text-gray-800 mb-4">{{ $product->nama }}</h2>
                <h3 class="text-3xl font-bold text-blue-600 mb-6">Rp {{ number_format($product->harga, 0, ',', '.') }}</h3>

                <p class="text-gray-600 mb-6 leading-relaxed">{{ $product->deskripsi }}</p>

                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <strong class="text-gray-700">Stok:</strong>
                    <span class="text-gray-900 font-semibold">{{ $product->stok }} pcs</span>
                </div>

                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="quantity" class="block text-gray-700 font-semibold mb-2">Jumlah</label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1"
                            max="{{ $product->stok }}"
                            class="w-32 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div class="flex space-x-4">
                        <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg transition font-semibold">
                            Tambah ke Keranjang
                        </button>
                        <a href="{{ route('products.index') }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg transition">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
