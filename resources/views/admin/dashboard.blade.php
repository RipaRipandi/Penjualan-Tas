@extends('layouts.admin.app')

@section('page-title', 'Dashboard')

@section('content')

<!-- STAT CARDS -->
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card" style="background:linear-gradient(135deg,#667eea,#764ba2);">
            <div class="label">Total Produk</div>
            <div class="number">{{ $totalProduk }}</div>
            <i class="fa fa-box icon"></i>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card" style="background:linear-gradient(135deg,#11998e,#38ef7d);">
            <div class="label">Total User</div>
            <div class="number">{{ $totalUser }}</div>
            <i class="fa fa-users icon"></i>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card" style="background:linear-gradient(135deg,#f7971e,#ffd200);">
            <div class="label">Total Transaksi</div>
            <div class="number">{{ $totalTransaksi }}</div>
            <i class="fa fa-receipt icon"></i>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card" style="background:linear-gradient(135deg,#f953c6,#b91d73);">
            <div class="label">Total Pendapatan (Sukses)</div>
            <div class="number" style="font-size:18px;">
                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
            </div>
            <i class="fa fa-money-bill icon"></i>
        </div>
    </div>
</div>

<!-- WARNING CARDS -->
<div class="row g-3 mb-4">
    @if($transaksiPending > 0)
    <div class="col-md-6">
        <div class="content-card p-3 d-flex align-items-center gap-3 border-start border-warning border-4">
            <div class="rounded-circle d-flex align-items-center justify-content-center bg-warning"
                 style="width:44px;height:44px;min-width:44px;">
                <i class="fa fa-clock text-white"></i>
            </div>
            <div>
                <div class="fw-semibold">{{ $transaksiPending }} Transaksi Pending</div>
                <div class="text-muted" style="font-size:13px;">Menunggu konfirmasi</div>
            </div>
            <a href="{{ route('admin.transaksi.index', ['status'=>'pending']) }}"
               class="btn btn-sm btn-warning ms-auto">Lihat</a>
        </div>
    </div>
    @endif

    @if($stokMenipis > 0)
    <div class="col-md-6">
        <div class="content-card p-3 d-flex align-items-center gap-3 border-start border-danger border-4">
            <div class="rounded-circle d-flex align-items-center justify-content-center bg-danger"
                 style="width:44px;height:44px;min-width:44px;">
                <i class="fa fa-exclamation-triangle text-white"></i>
            </div>
            <div>
                <div class="fw-semibold">{{ $stokMenipis }} Produk Stok Menipis</div>
                <div class="text-muted" style="font-size:13px;">Stok ≤ 5, segera restock</div>
            </div>
            <a href="{{ route('admin.laporan.index') }}"
               class="btn btn-sm btn-danger ms-auto">Lihat</a>
        </div>
    </div>
    @endif
</div>

<div class="row g-4 mb-4">

    <!-- TRANSAKSI TERBARU -->
    <div class="col-lg-8">
        <div class="content-card p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0 fw-semibold">Transaksi Terbaru</h6>
                <a href="{{ route('admin.transaksi.index') }}" class="btn btn-sm btn-outline-primary">
                    Lihat Semua
                </a>
            </div>
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksiTerbaru as $t)
                    <tr>
                        <td>{{ $t->id_transaksi }}</td>
                        <td>{{ $t->user->nama ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d M Y') }}</td>
                        <td>Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                        <td>
                            @if($t->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($t->status == 'sukses')
                                <span class="badge bg-success">Sukses</span>
                            @else
                                <span class="badge bg-danger">Batal</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted py-3">Belum ada transaksi</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- SHORTCUT -->
    <div class="col-lg-4">
        <div class="content-card p-4 h-100">
            <h6 class="fw-semibold mb-3">Aksi Cepat</h6>
            <div class="d-flex flex-column gap-2">
                <a href="{{ route('admin.produk.create') }}"
                   class="btn btn-outline-primary text-start">
                    <i class="fa fa-plus me-2"></i> Tambah Produk
                </a>
                <a href="{{ route('admin.user.create') }}"
                   class="btn btn-outline-success text-start">
                    <i class="fa fa-user-plus me-2"></i> Tambah User
                </a>
                <a href="{{ route('admin.transaksi.index', ['status'=>'pending']) }}"
                   class="btn btn-outline-warning text-start">
                    <i class="fa fa-clock me-2"></i> Transaksi Pending
                </a>
                <a href="{{ route('admin.laporan.index') }}"
                   class="btn btn-outline-info text-start">
                    <i class="fa fa-chart-bar me-2"></i> Lihat Laporan
                </a>
            </div>
        </div>
    </div>

</div>

@endsection