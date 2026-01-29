<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ini ambil session cart sesuai dengan User_id
        $cartKey = 'cart_' . Auth::id();
        $cart = session()->get($cartKey, []);

        // session()->forget('cart'); (Ini untuk hapus session sementara forget())

        return view('cart.index', compact('cart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addToCart(Request $request, Produk $produk)
    {
        $cart = session()->get('cart', []);
        // $cart['test'] = 'masuk';

        $qty = max(1, (int) $request->quantity);

        // Ini untuk nambahin ke session cart.  Fungsi qty ini sebagai bayangan untuk jumlah produk
        // Yang bakal masuk ke cart
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

        // dd(session()->get('cart'));

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
    public function updateCart(Request $request, Produk $produk)
    {
        // Ini buat liat juga stok dari db, biar pas input qty ke cart
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $produk->stok_produk,
        ]);

        $cart = session()->get('cart', []);

        //Ini kondiis kalau id produk nya nggak sesuai
        if(!isset($cart[$produk->id])){
            return redirect()->route('cart.index')->with('error', 'Produk tidak ada di keranjang!');
        }

        $cart[$produk->id]['quantity'] = (int) $request->quantity;
        session()->put('cart', $cart);

        // if (isset($cart[$produk->id])) {
        //     $cart[$produk->id]['quantity'] = (int) $request->quantity;
        //     session()->put('cart', $cart);
        // }

        return redirect()->route('cart.index');
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
