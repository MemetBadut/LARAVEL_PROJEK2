<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::select(['id', 'user_id', 'total_harga', 'order_status', 'alamat_pengiriman', 'provinsi', 'kota', 'kode_pos'])
        ->with([
            'customer:id,name',
            'orderItems:id,order_id,produk_id,jumlah_barang,harga_satuan',
            'orderItems.produk:id,nama_produk'
        ])
        ->where('user_id', Auth::id())
        ->get();

        return view('order.index', compact('orders'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show( OrderController $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( OrderController $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderController $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderController $order)
    {
        //
    }
}
