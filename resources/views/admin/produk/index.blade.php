@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Daftar Produk</h2>
                <a href="{{ route('admin.produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produks as $key => $produk)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $produk->nama }}</td>
                                <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                <td>{{ $produk->stok }}</td>
                                <td>
                                    <a href="{{ route('admin.produk.edit', $produk->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.produk.destroy', $produk->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin hapus?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
