<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'nama_tas',
        'harga',
        'stok',
        'deskripsi'
    ];

    // Relasi ke detail transaksi
    public function TransaksiDetail()
    {
        return $this->hasMany(TransaksiDetail::class, 'id_produk', 'id_produk');
    }
}