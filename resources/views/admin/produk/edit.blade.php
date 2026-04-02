<h2>Edit Produk</h2>

@if(session('success'))
<p>{{ session('success') }}</p>
@endif

<form action="{{ route('produk.update', $produk->id_produk) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="nama_tas" value="{{ $produk->nama_tas }}"><br>
    <input type="number" name="harga" value="{{ $produk->harga }}"><br>
    <input type="number" name="stok" value="{{ $produk->stok }}"><br>
    <textarea name="deskripsi">{{ $produk->deskripsi }}</textarea><br>

    <button type="submit">Update</button>
</form>
