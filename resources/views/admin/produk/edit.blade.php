@extends('layouts.admin.app')

@section('page-title', 'Edit Produk')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="content-card p-4">
            <h5 class="fw-semibold mb-4">Edit Produk: {{ $produk->nama_tas }}</h5>

            <form action="{{ route('admin.produk.update', $produk->id_produk) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Tas</label>
                    <input type="text" name="nama_tas" class="form-control @error('nama_tas') is-invalid @enderror"
                           value="{{ old('nama_tas', $produk->nama_tas) }}">
                    @error('nama_tas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Harga (Rp)</label>
                    <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror"
                           value="{{ old('harga', $produk->harga) }}">
                    @error('harga') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Stok</label>
                    <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror"
                           value="{{ old('stok', $produk->stok) }}">
                    @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi" rows="3"
                              class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                    @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Gambar Produk</label>

                    @if($produk->gambar)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $produk->gambar) }}" width="120" class="rounded">
                        </div>
                    @endif

                    <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror">
                    @error('gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa fa-save me-1"></i> Update
                    </button>
                    <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary px-4">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection