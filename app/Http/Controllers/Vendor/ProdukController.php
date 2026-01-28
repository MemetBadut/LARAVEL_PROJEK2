<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\DTO\VendorProdukDTO;
use App\DTO\VendorProdukSummaryDTO;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendorId = Auth::id();
        $baseQuery = Produk::where('vendor_id', $vendorId);

        $dto = new VendorProdukSummaryDTO(
            totalProduk : (clone $baseQuery)->count(),
            totalStok: (clone $baseQuery)->sum('stok_produk'),
            hampirHabis: (clone $baseQuery)->hampirHabis()->count(),
            produks: (clone $baseQuery)->latest()->get()
        );

        return view('vendorpage.produk.index', compact( 'dto'));
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
    public function destroy(string $id)
    {
        //
    }
}
