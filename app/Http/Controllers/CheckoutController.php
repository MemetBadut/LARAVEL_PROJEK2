<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Alamat;
use App\Models\Produk;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Services\CheckoutService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Services\CheckoutSummaryService;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CheckoutSummaryService $service)
    {
        try {
            $summary = $service->summary();
        } catch (\Exception $e) {
            return redirect()
                ->route('cart.index')
                ->with('error', $e->getMessage());
        }

        // dd($produkIds);
        return view('checkout.index', compact('summary'));
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
    public function store(Request $request, CheckoutService $checkoutService)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang kosong');
        }

        $address = Alamat::where('user_id', Auth::id())
            ->where('is_default', true)
            ->first();

        if (!$address) {
            return back()->with('error', 'Alamat belum tersedia');
        }

        try {
            $order = $checkoutService->process($cart, $address);
        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }

        session()->forget('cart');

        return redirect()->route('orders.index')
            ->with('success', 'Checkout berhasil');
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
