@extends('layouts.admin.app')

@section('page-title', 'Kelola Transaksi')

@section('content')

<div class="content-card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <h5 class="mb-0 fw-semibold">Semua Transaksi</h5>

        <!-- Filter Status -->
        <form method="GET" action="{{ route('admin.transaksi.index') }}" class="d-flex gap-2">
            <select name="status" class="form-select form-select-sm" style="width:150px;">
                <option value="">Semua Status</option>
                <option value="pending" {{ ($statusFilter??'')==='pending' ? 'selected':'' }}>Pending</option>
                <option value="sukses"  {{ ($statusFilter??'')==='sukses'  ? 'selected':'' }}>Sukses</option>
                <option value="batal"   {{ ($statusFilter??'')==='batal'   ? 'selected':'' }}>Batal</option>
            </select>
            <button class="btn btn-sm btn-primary">Filter</button>
            @if($statusFilter)
                <a href="{{ route('admin.transaksi.index') }}" class="btn btn-sm btn-secondary">Reset</a>
            @endif
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>User</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksis as $t)
                <tr>
                    <td>{{ $t->id_transaksi }}</td>
                    <td>{{ $t->user->nama ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d M Y') }}</td>
                    <td>Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                    <td>
                        @if($t->status == 'pending')
                            <span class="badge bg-warning text-dark badge-status">Pending</span>
                        @elseif($t->status == 'sukses')
                            <span class="badge bg-success badge-status">Sukses</span>
                        @else
                            <span class="badge bg-danger badge-status">Batal</span>
                        @endif
                    </td>
                    <td class="d-flex gap-1 flex-wrap">
                        <a href="{{ route('admin.transaksi.show', $t->id_transaksi) }}"
                           class="btn btn-sm btn-info text-white">
                            <i class="fa fa-eye"></i> Detail
                        </a>
                        <form action="{{ route('admin.transaksi.updateStatus', $t->id_transaksi) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="form-select form-select-sm d-inline w-auto"
                                    onchange="this.form.submit()">
                                <option value="pending" {{ $t->status=='pending' ? 'selected':'' }}>Pending</option>
                                <option value="sukses"  {{ $t->status=='sukses'  ? 'selected':'' }}>Sukses</option>
                                <option value="batal"   {{ $t->status=='batal'   ? 'selected':'' }}>Batal</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Tidak ada transaksi</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection