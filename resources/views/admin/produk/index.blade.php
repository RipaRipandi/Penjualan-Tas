@extends('layouts.admin.app')

@section('page-title', 'Kelola Produk')

@section('content')

<div class="content-card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0 fw-semibold">Daftar Produk</h5>
        <a href="{{ route('admin.produk.create') }}" class="btn btn-primary">
            <i class="fa fa-plus me-1"></i> Tambah Produk
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Tas</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produks as $produk)
                <tr>
                    <td>{{ $produk->id_produk }}</td>
                    <td><strong>{{ $produk->nama_tas }}</strong></td>
                    <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                    <td>
                        @if($produk->stok > 5)
                            <span class="badge bg-success">{{ $produk->stok }}</span>
                        @elseif($produk->stok > 0)
                            <span class="badge bg-warning text-dark">{{ $produk->stok }}</span>
                        @else
                            <span class="badge bg-danger">Habis</span>
                        @endif
                    </td>
                    <td class="text-muted" style="max-width:200px;">
                        {{ Str::limit($produk->deskripsi, 50) }}
                    </td>
                    <td>
                        @if($produk->gambar)
                            <img src="{{ asset('storage/' . $produk->gambar) }}" width="60" class="rounded">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.produk.edit', $produk->id_produk) }}"
                           class="btn btn-sm btn-warning me-1">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.produk.destroy', $produk->id_produk) }}"
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin hapus produk ini?')">
                                <i class="fa fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada produk</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection