@extends('layouts.admin.app')

@section('page-title', 'Detail Transaksi')

@section('content')

<div class="row">
    <div class="col-md-8">
        <div class="content-card p-4 mb-4">
            <h5 class="fw-semibold mb-1">Order #{{ $transaksi->id_transaksi }}</h5>
            <p class="text-muted mb-4">{{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d M Y') }}</p>

            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksi->details as $detail)
                    <tr>
                        <td>{{ $detail->produk->nama_tas ?? '-' }}</td>
                        <td>Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                        <td>{{ $detail->jumlah }}</td>
                        <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end fw-bold">Total</td>
                        <td class="fw-bold text-primary">
                            Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="col-md-4">
        <div class="content-card p-4 mb-3">
            <h6 class="fw-semibold mb-3">Info Pembeli</h6>
            <p class="mb-1"><strong>Nama:</strong> {{ $transaksi->user->nama ?? '-' }}</p>
            <p class="mb-1"><strong>Email:</strong> {{ $transaksi->user->email ?? '-' }}</p>
            <p class="mb-0"><strong>Alamat:</strong> {{ $transaksi->user->alamat ?? '-' }}</p>
        </div>

        <div class="content-card p-4">
            <h6 class="fw-semibold mb-3">Update Status</h6>
            <form action="{{ route('admin.transaksi.updateStatus', $transaksi->id_transaksi) }}" method="POST">
                @csrf
                @method('PATCH')
                <select name="status" class="form-select mb-3">
                    <option value="pending" {{ $transaksi->status=='pending' ? 'selected':'' }}>Pending</option>
                    <option value="sukses"  {{ $transaksi->status=='sukses'  ? 'selected':'' }}>Sukses</option>
                    <option value="batal"   {{ $transaksi->status=='batal'   ? 'selected':'' }}>Batal</option>
                </select>
                <button class="btn btn-primary w-100">
                    <i class="fa fa-save me-1"></i> Update Status
                </button>
            </form>
        </div>
    </div>
</div>

<a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary">
    <i class="fa fa-arrow-left me-1"></i> Kembali
</a>

@endsection