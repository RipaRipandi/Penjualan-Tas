<h2>Edit Transaksi</h2>

<form action="{{ route('transaksi.update', $transaksi->id_transaksi) }}" method="POST">
    @csrf
    @method('PUT')

    <label>User</label>
    <select name="id_user">
        @foreach($users as $user)
        <option value="{{ $user->id }}" {{ $transaksi->id_user == $user->id ? 'selected' : '' }}>
            {{ $user->nama }}
        </option>
        @endforeach
    </select><br>

    <input type="date" name="tanggal" value="{{ $transaksi->tanggal }}"><br>
    <input type="number" name="total_harga" value="{{ $transaksi->total_harga }}"><br>

    <select name="status">
        <option value="pending" {{ $transaksi->status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="selesai" {{ $transaksi->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
    </select><br>

    <button type="submit">Update</button>
</form>
