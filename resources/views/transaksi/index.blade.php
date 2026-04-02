<h2>Data Transaksi</h2>

<a href="{{ route('transaksi.create') }}">Tambah Transaksi</a>

@if(session('success'))
<p>{{ session('success') }}</p>
@endif

<table border="1">
    <tr>
        <th>ID</th>
        <th>User</th>
        <th>Tanggal</th>
        <th>Total</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($transaksi as $t)
    <tr>
        <td>{{ $t->id_transaksi }}</td>
        <td>{{ $t->user->nama ?? '-' }}</td>
        <td>{{ $t->tanggal }}</td>
        <td>{{ $t->total_harga }}</td>
        <td>{{ $t->status }}</td>
        <td>
            <a href="{{ route('transaksi.edit', $t->id_transaksi) }}">Edit</a>
        </td>
    </tr>
    @endforeach
</table>
