<h2>Tambah Transaksi</h2>

<form action="{{ route('transaksi.store') }}" method="POST">
    @csrf

    <label>User</label>
    <select name="id_user">
        @foreach($users as $user)
        <option value="{{ $user->id }}">{{ $user->nama }}</option>
        @endforeach
    </select><br>

    <input type="date" name="tanggal"><br>
    <input type="number" name="total_harga" placeholder="Total Harga"><br>

    <select name="status">
        <option value="pending">Pending</option>
        <option value="selesai">Selesai</option>
    </select><br>

    <button type="submit">Simpan</button>
</form>
