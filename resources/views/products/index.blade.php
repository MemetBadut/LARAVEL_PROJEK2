@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Daftar Produk</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($products as $produk)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                    @if ($produk->gambar)
                        <img src="{{ asset('storage/' . $produk->gambar) }}" class="w-full h-48 object-cover"
                            alt="{{ $produk->nama_produk }}">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400">No Image</span>
                        </div>
                    @endif
                    <div class="p-4">
                        <h5 class="text-lg font-bold text-gray-800 mb-2">{{ $produk->nama_produk }}</h5>
                        <p class="text-2xl font-bold text-blue-600 mb-4">Rp
                            {{ number_format($produk->harga_produk, 0, ',', '.') }}</p>
                        <div class="flex space-x-2">
                            <a href="{{ route('products.show', $produk->id) }}"
                                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center px-4 py-2 rounded-lg transition">
                                Detail
                            </a>
                            <form action="{{ route('cart.add', $produk->id) }}" method="POST" class="flex-1">
                                @csrf
                                <button type="submit"
                                    class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition">
                                    + Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 text-center">
                        <p class="text-blue-800">Belum ada produk tersedia</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
    {{ $products->links() }}
@endsection
