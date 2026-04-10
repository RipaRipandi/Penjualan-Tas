@extends('layouts.admin.app')

@section('page-title', 'Laporan')

@section('content')

<!-- FILTER TANGGAL -->
<div class="content-card p-4 mb-4">
    <form method="GET" action="{{ route('admin.laporan.index') }}" class="row g-3 align-items-end">
        <div class="col-md-4">
            <label class="form-label fw-semibold">Dari Tanggal</label>
            <input type="date" name="dari" value="{{ $dari }}" class="form-control">
        </div>
        <div class="col-md-4">
            <label class="form-label fw-semibold">Sampai Tanggal</label>
            <input type="date" name="sampai" value="{{ $sampai }}" class="form-control">
        </div>
        <div class="col-md-4">
            <button class="btn btn-primary w-100">
                <i class="fa fa-search me-1"></i> Tampilkan
            </button>
        </div>
    </form>
</div>

<!-- STAT PERIODE -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card" style="background:linear-gradient(135deg,#11998e,#38ef7d);">
            <div class="label">Pendapatan Periode Ini</div>
            <div class="number" style="font-size:18px;">
                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
            </div>
            <i class="fa fa-money-bill icon"></i>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card" style="background:linear-gradient(135deg,#667eea,#764ba2);">
            <div class="label">Transaksi Sukses</div>
            <div class="number">{{ $totalSukses }}</div>
            <i class="fa fa-check-circle icon"></i>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card" style="background:linear-gradient(135deg,#f7971e,#ffd200);">
            <div class="label">Transaksi Pending</div>
            <div class="number">{{ $totalPending }}</div>
            <i class="fa fa-clock icon"></i>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card" style="background:linear-gradient(135deg,#f953c6,#b91d73);">
            <div class="label">Transaksi Batal</div>
            <div class="number">{{ $totalBatal }}</div>
            <i class="fa fa-times-circle icon"></i>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">

    <!-- PENDAPATAN PER HARI -->
    <div class="col-lg-8">
        <div class="content-card p-4">
            <h6 class="fw-semibold mb-3">Pendapatan Per Hari</h6>
            @if($pendapatanHarian->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Jumlah Transaksi</th>
                            <th>Total Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendapatanHarian as $p)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d M Y') }}</td>
                            <td>{{ $p->jumlah }} transaksi</td>
                            <td class="fw-semibold text-success">
                                Rp {{ number_format($p->total, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="table-success">
                            <td colspan="2" class="fw-bold">Total</td>
                            <td class="fw-bold">
                                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            @else
            <p class="text-muted text-center py-3">Tidak ada data pendapatan pada periode ini</p>
            @endif
        </div>
    </div>

    <!-- STOK MENIPIS -->
    <div class="col-lg-4">
        <div class="content-card p-4">
            <h6 class="fw-semibold mb-3 text-danger">
                <i class="fa fa-exclamation-triangle me-1"></i>
                Stok Menipis (≤ 5)
            </h6>
            @if($stokMenipis->count() > 0)
            <div class="list-group list-group-flush">
                @foreach($stokMenipis as $p)
                <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                    <span>{{ $p->nama_tas }}</span>
                    <span class="badge {{ $p->stok == 0 ? 'bg-danger' : 'bg-warning text-dark' }}">
                        {{ $p->stok == 0 ? 'Habis' : 'Sisa '.$p->stok }}
                    </span>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-muted text-center py-3">Semua stok aman ✅</p>
            @endif
        </div>
    </div>

</div>

<!-- PRODUK TERLARIS -->
<div class="content-card p-4">
    <h6 class="fw-semibold mb-3">
        <i class="fa fa-trophy me-1 text-warning"></i>
        Produk Terlaris Periode Ini
    </h6>
    @if($produkTerlaris->count() > 0)
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Peringkat</th>
                    <th>Nama Produk</th>
                    <th>Total Terjual</th>
                    <th>Total Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produkTerlaris as $i => $p)
                <tr>
                    <td>
                        @if($i == 0)
                            <span class="badge bg-warning text-dark fs-6">🥇 1</span>
                        @elseif($i == 1)
                            <span class="badge bg-secondary fs-6">🥈 2</span>
                        @elseif($i == 2)
                            <span class="badge" style="background:#cd7f32;font-size:14px;">🥉 3</span>
                        @else
                            <span class="text-muted">{{ $i + 1 }}</span>
                        @endif
                    </td>
                    <td><strong>{{ $p->nama_tas }}</strong></td>
                    <td>{{ $p->total_terjual }} pcs</td>
                    <td class="text-success fw-semibold">
                        Rp {{ number_format($p->total_pendapatan, 0, ',', '.') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <p class="text-muted text-center py-3">Belum ada penjualan pada periode ini</p>
    @endif
</div>

@endsection