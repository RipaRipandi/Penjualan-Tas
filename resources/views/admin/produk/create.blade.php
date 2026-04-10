@extends('layouts.admin.app')

@section('page-title', 'Tambah Produk')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="content-card p-4">
            <h5 class="fw-semibold mb-4">Form Tambah Produk</h5>

            <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Tas</label>
                    <input type="text" name="nama_tas" class="form-control @error('nama_tas') is-invalid @enderror"
                           value="{{ old('nama_tas') }}" placeholder="Contoh: Tas Ransel Pria">
                    @error('nama_tas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Harga (Rp)</label>
                    <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror"
                           value="{{ old('harga') }}" placeholder="Contoh: 250000">
                    @error('harga') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Stok</label>
                    <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror"
                           value="{{ old('stok') }}" placeholder="Contoh: 10">
                    @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi" rows="3"
                              class="form-control @error('deskripsi') is-invalid @enderror"
                              placeholder="Deskripsi produk...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Gambar Produk</label>
                    <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror">
                    @error('gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa fa-save me-1"></i> Simpan
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