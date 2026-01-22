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
        $orders = Order::query()
            ->forUser(Auth::id())
            ->withDetail()
            ->orderBy('id', 'desc')
            ->get();
        // dd($orders);
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
    public function show(OrderController $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderController $order)
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
