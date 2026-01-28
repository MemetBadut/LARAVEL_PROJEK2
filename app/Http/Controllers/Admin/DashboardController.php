<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DTO\AdminDashboardSummaryDTO;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $latestProduks = Produk::with(['kategori', 'vendor'])
            ->when($request->status, function ($q, $status) {
                match ($status) {
                    'tersedia' => $q->tersedia(),
                    'hampir_habis' => $q->hampirHabis(),
                    'habis' => $q->habis(),
                    default => null,
                };
            })
            ->when($request->filled('stock_range'), function ($q) use ($request) {
                $q->filterStock($request->stock_range);
            })
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->search(trim($request->search));
            })->paginate(5)->withQueryString();

            $dashboard = new AdminDashboardSummaryDTO(
                totalProduk: Produk::sum('stok_produk'),
                totalStok: Produk::count(),
                habis: Produk::habis()->count(),
                hampirHabis: Produk::hampirHabis()->count(),
                penjualan: Order::where('order_status', 'selesai')->sum('total_harga'),
                customer: Order::distinct('user_id')->count('user_id'),
                pending: Order::where('order_status', 'pending')->count(),
            );

        return view('admin.dashboard', compact('latestProduks','dashboard'));
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
