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
        $qty = ((int) $request->quantity) ?? 1;

        $cart = session()->get('cart', []);

        if (isset($cart[$produk->id])) {
            $cart[$produk->id]['quantity'] += $qty;
        } else {
            $cart[$produk->id] = [
                'produk_id' => $produk->id,
                'nama_produk' => $produk->nama_produk,
                'harga_produk' => $produk->harga_produk,
                'quantity' => $qty,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index', [
            'page' => $request->page
        ])->with('success', 'Produk berhasil ditambahkan ke keranjang');
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
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = (int) $request->quantity;
            session()->put('cart', $cart);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function removeFromCart(Produk $produk)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$produk->id])) {
            unset($cart[$produk->id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')
            ->with('success', 'Produk berhasil dihapus dari keranjang');
    }
}
