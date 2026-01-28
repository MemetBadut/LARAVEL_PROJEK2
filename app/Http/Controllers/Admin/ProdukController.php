<?php

namespace App\Http\Controllers\Admin;

use App\DTO\ProdukCountDTO;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KategoriProduk;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $produks = Produk::with(['kategori', 'vendor'])
            ->when(
                $request->status === 'tersedia',
                fn($q) => $q->tersedia()
            )
            ->when(
                $request->status === 'hampir_habis',
                fn($q) => $q->hampirHabis()
            )
            ->when(
                $request->status === 'habis',
                fn($q) => $q->habis()
            )
            ->when($request->filled('cari'), fn($q) => $q->search($request->cari))
            ->paginate(10)
            ->withQueryString();

            $countStok = new ProdukCountDTO(
                stokReady: Produk::tersedia()->count(),
                stokLow: Produk::hampirHabis()->count()
            );

        return view('admin.produk.index', compact('produks', 'countStok'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = KategoriProduk::with('children')
            ->whereNull('parent_id')
            ->get();

        return view('admin.produk.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga_produk' => 'required|numeric|min:0',
            'stok_produk' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validated['stok_produk'] = 0) {
            $validated['status_produk'] = 'habis';
        } elseif ($validated['stok_produk'] > 0 && $validated['stok_produk'] <= 10) {
            $validated['status_produk'] = 'hampir_habis';
        } else {
            $validated['status_produk'] = 'tersedia';
        }

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')
                ->store('imageproduk', 'public');
        }

        Produk::create($validated);

        return redirect()
            ->route('admin.products.create')
            ->with('success', 'Produk berhasil ditambahkan!');
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
        return view('admin.produk.edit', [
            'produk' => Produk::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Cari Produk sesuai ID
        $produk = Produk::findOrFail($id);

        $rules = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga_produk' => 'required|numeric|min:0',
            'stok_produk' => 'required|integer|min:0',
            'deskripsi_produk' => 'nullable|string',
            'gambar' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //Handle Gambar Produk
        if ($request->hasFile('gambar')) {
            //Hapus gambar lama kalau ada
            if ($produk->gambar) {
                Storage::delete($produk->gambar);
            }
            // Generate unique filename
            $filename = time() . '_' . $request->file('gambar')->getClientOriginalName();
            //Ini untuk simpen gambar
            $path = $request->file('gambar')->storeAs('produk_images', $filename, 'public');
            //Ini biar path nya nambah ke validate gambar
            $validate['gambar'] = $path;
        }

        $produk->update($validate);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        $this->authorize('delete', $produk);

        $produk->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}
