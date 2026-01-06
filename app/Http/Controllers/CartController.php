<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = session()->get('cart', []);

        return view('cart.index', compact('cart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addToCart(Request $request, Produk $produk)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$produk->id])){
            $cart[$produk->id]['stok_produk'] += $request->stok_produk ?? 1;
        }else{
            $cart[$produk->id] = [
                'produk_id' => $produk->id,
                'nama_produk' => $produk->nama_produk,
                'harga_produk' => $produk->harga_produk,
                'stok_produk' => $request->stok_produk ?? 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')
        ->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function removeFromCart(Produk $produk)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$produk->id])){
            unset($cart[$produk->id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')
        ->with('success', 'Produk berhasil dihapus dari keranjang');
    }
}
