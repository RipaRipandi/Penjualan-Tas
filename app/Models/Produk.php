<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Produk extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'nama_tas',
        'harga',
        'stok',
        'deskripsi',
        'gambar'
    ];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'product_id', 'id_produk');
    }

    public function TransaksiDetail()
    {
        return $this->hasMany(TransaksiDetail::class, 'id_produk', 'id_produk');
    }
}