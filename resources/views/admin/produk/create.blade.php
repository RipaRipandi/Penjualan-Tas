<h2>Tambah Produk</h2>

@if(session('success'))
<p>{{ session('success') }}</p>
@endif

<form action="{{ route('produk.store') }}" method="POST">
    @csrf

    <input type="text" name="nama_tas" placeholder="Nama Tas"><br>
    <input type="number" name="harga" placeholder="Harga"><br>
    <input type="number" name="stok" placeholder="Stok"><br>
    <textarea name="deskripsi" placeholder="Deskripsi"></textarea><br>

    <button type="submit">Simpan</button>
</form>
