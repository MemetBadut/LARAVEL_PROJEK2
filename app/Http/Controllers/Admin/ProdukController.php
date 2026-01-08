<?php

namespace App\Http\Controllers\Admin;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produks = Produk::select('id', 'nama_produk', 'harga_produk', 'stok_produk')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.produk.index', compact('produks'));
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
    public function store(Request $request) {}

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
        ]);

        if($request->hasFile('gambar')){
            $rules['gambar'] = 'sometimes|image|mime::jpeg,png,jpg,gif,svg|max:2048';
        }
        // Validasi Request
        $validate = $request->validate($rules);

        //Handle Gambar Produk
        if($request->hasFile('gambar')){
            //Hapus gambar lama kalau ada
            if($produk->gambar){
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
