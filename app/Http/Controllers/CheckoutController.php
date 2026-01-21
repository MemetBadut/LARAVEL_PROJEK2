<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Alamat;
use App\Models\Produk;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $cartItems = session()->get('cart', []);
        $produkIds = collect($cartItems)->pluck('produk_id')->toArray();
        $subtotal = collect($cartItems)->sum(function ($item) {
            return ($item['harga_produk'] ?? 0) * ($item['quantity'] ?? 0);
        });

        $produk = Produk::whereIn('id', $produkIds)
            ->select('id', 'nama_produk', 'harga_produk', 'gambar')
            ->get()
            ->keyBy('id');

        $alamatUser = Alamat::where('user_id', $user->id)
            ->where('is_default', true)
            ->first()
            ?? Alamat::where('user_id', $user->id)->first();

        if (empty($cartItems)) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang kosong, silakan tambahkan produk terlebih dahulu.');
        }

        // dd($produkIds);
        return view('checkout.index', compact('cartItems', 'alamatUser', 'produk', 'subtotal', 'total', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index');
        }


        $address = Alamat::where('user_id', Auth::id())
            ->where('is_default', true)
            ->first();

        if (!$address) {
            return back()->with('error', 'Alamat tidak ada atau tersedia!');
        }

        foreach ($cart as $item) {
            if (
                !isset($item['produk_id'], $item['harga_produk'], $item['quantity'])
            ) {
                return back()->with(
                    'error',
                    'Data keranjang rusak. Silakan ulangi checkout.'
                );
            }
        }

        try {

            DB::transaction(function () use ($cart, $address) {
                $subtotal = collect($cart)->sum(function ($item) {
                    return $item['harga_produk'] * $item['quantity'];
                });
                $tax = $subtotal * 0.11;
                $total = $subtotal + $tax;

                $order = Order::create([
                    'user_id' => Auth::id(),
                    'total_harga' => $total,
                    'status' => 'pending',
                    'alamat_pengiriman' => $address->alamat_lengkap,
                    'provinsi' => $address->provinsi,
                    'kota' => $address->kota,
                    'kode_pos' => $address->kode_pos,
                ]);

                foreach ($cart as $item) {
                    $produk = Produk::lockForUpdate()->find($item['produk_id']);

                    if (!$produk) {
                        throw new \Exception("Produk dengan ID {$item['produk_id']} tidak ditemukan");
                    }

                    OrderItem::create([
                        'order_id' => $order->id,
                        'produk_id' => $produk->id,
                        'jumlah_barang' => $item['quantity'],
                        'harga_satuan' => $item['harga_produk'],
                    ]);

                    $produk->decrement('stok_produk', $item['quantity']);
                }
            });
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat proses checkout: ' . $e->getMessage());
        }


        session()->forget('cart');

        return redirect()->route('orders.index')
            ->with('success', 'Checkout berhasil! Pesanan Anda sedang diproses.');
    }

    /**
     * Display the specified resource.
     */
    public function show() {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
