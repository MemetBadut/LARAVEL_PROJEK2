<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Produk $produk)
    {
        $user = Auth::user();

        return view('checkout.index', compact('produk', ['cart' => session('cart')], 'user'));
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

        if (!$cart || count($cart) == 0) {
            return back()->with('error', 'Keranjang kosong, silakan tambahkan produk terlebih dahulu.');
        }

        try {
            DB::transaction(function () use ($cart) {
                $order = Order::create([
                    'user_id' => Auth::id(),
                    'total_harga' => collect($cart)->sum(function ($item) {
                        return $item['harga_produk'] * $item['quantity'];
                    }),
                    'status' => 'pending',
                ]);

                foreach ($cart as $item) {
                    $produk = Produk::lockForUpdate()->find($item['produk_id']);

                    if ($produk->stok_produk < $item['quantity']) {
                        throw new \Exception("Stok produk {$produk->nama_produk} tidak mencukupi.");
                    }

                    OrderItem::create([
                        'order_id' => $order->id,
                        'produk_id' => $produk->id,
                        'quantity' => $item['stok_produk'],
                        'harga_produk' => $item['harga_produk'],
                    ]);

                    $produk->decrement('stok_produk', $item['stok_produk']);
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
    public function show()
    {
    }

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
