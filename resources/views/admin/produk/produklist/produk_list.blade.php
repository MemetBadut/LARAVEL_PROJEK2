 <div class="overflow-x-auto">
     <table class="min-w-full divide-y divide-gray-200">
         <thead>
             <tr class="bg-gray-50">
                 <th scope="col"
                     class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                     Product
                 </th>
                 <th scope="col"
                     class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                     Price
                 </th>
                 <th scope="col"
                     class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                     Stock
                 </th>
                 <th scope="col"
                     class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                     Status
                 </th>
                 <th scope="col"
                     class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                     Actions
                 </th>
             </tr>
         </thead>
         <tbody class="divide-y divide-gray-200">
             @forelse($produks as $key => $produk)
                 <tr class="hover:bg-gray-50 transition">
                     {{-- Product Info --}}
                     <td class="px-6 py-4">
                         <div class="flex items-center">
                             <div class="w-12 h-12 shrink-0 bg-gray-100 rounded-lg flex items-center justify-center">
                                 @if ($produk->gambar)
                                     <img src="{{ asset('storage/' . $produk->gambar) }}"
                                         alt="{{ $produk->nama_produk }}" class="w-full h-full object-cover">
                                 @else
                                     <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                             d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                         </path>
                                     </svg>
                                 @endif
                             </div>
                             <div class="ml-4">
                                 <div class="text-sm font-semibold text-gray-900">{{ $produk->nama_produk }}
                                 </div>
                                 <div class="text-xs text-gray-500">ID: {{ $produk->id }}</div>
                             </div>
                         </div>
                     </td>

                     {{-- Price --}}
                     <td class="px-6 py-4 whitespace-nowrap">
                         <div class="text-sm font-semibold text-gray-900">Rp
                             {{ number_format($produk->harga_produk, 0, ',', '.') }}</div>
                     </td>

                     {{-- Stock --}}
                     <td class="px-6 py-4 whitespace-nowrap">
                         <div class="text-sm text-gray-900">{{ $produk->stok_produk }} units</div>
                     </td>

                     {{-- @php
                                    $produk =
                                @endphp --}}
                     {{-- Status --}}
                     <td class="px-6 py-4 whitespace-nowrap">
                         @if ($produk->stok_produk > 10)
                             <span
                                 class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                 <span class="w-2 h-2 mr-1.5 rounded-full bg-green-400"></span>
                                 In Stock
                             </span>
                         @elseif($produk->stok_produk > 0)
                             <span
                                 class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                 <span class="w-2 h-2 mr-1.5 rounded-full bg-yellow-400"></span>
                                 Low Stock
                             </span>
                         @else
                             <span
                                 class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                 <span class="w-2 h-2 mr-1.5 rounded-full bg-red-400"></span>
                                 Out of Stock
                             </span>
                         @endif
                     </td>

                     {{-- Actions --}}
                     <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                         <div class="flex items-center justify-end space-x-2">
                             <a href="{{ route('admin.products.show', $produk->id) }}"
                                 class="text-gray-600 hover:text-blue-600 transition" title="View">
                                 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                         d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                         d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                     </path>
                                 </svg>
                             </a>
                             <a href="{{ route('admin.products.edit', $produk->id) }}"
                                 class="text-gray-600 hover:text-blue-600 transition" title="Edit">
                                 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                         d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                     </path>
                                 </svg>
                             </a>
                             <form action="{{ route('admin.products.destroy', $produk->id) }}" method="POST"
                                 class="inline-block">
                                 @csrf
                                 @method('DELETE')
                                 <button type="submit" onclick="return confirm('Delete this product?')"
                                     class="text-gray-600 hover:text-red-600 transition" title="Delete">
                                     <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                             d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                         </path>
                                     </svg>
                                 </button>
                             </form>
                         </div>
                     </td>
                 </tr>
             @empty
                 <tr>
                     <td colspan="5" class="px-6 py-16 text-center">
                         <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                 d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                             </path>
                         </svg>
                         <p class="text-gray-500 font-medium">No products found</p>
                         <p class="text-gray-400 text-sm mt-1">Get started by adding your first product</p>
                         <a href="{{ route('admin.products.create') }}"
                             class="inline-flex items-center mt-4 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition text-sm font-medium">
                             <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                     d="M12 4v16m8-8H4"></path>
                             </svg>
                             Add First Product
                         </a>
                     </td>
                 </tr>
             @endforelse
         </tbody>
     </table>
 </div>
