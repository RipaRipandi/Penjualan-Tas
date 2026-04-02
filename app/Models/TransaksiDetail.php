<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    protected $table = 'transaksi_details';    // pastikan sesuai nama tabel di DB
    protected $primaryKey = 'id_detail';        // sesuai primary key di DB
    public $timestamps = false;                  // jika tidak pakai created_at dan updated_at

    protected $fillable = [
        'id_transaksi',
        'id_produk',
        'jumlah',
        'harga',
        'subtotal',
    ];

    // Relasi ke transaksi
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'id_transaksi', 'id_transaksi');
    }

    // Relasi ke produk
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_produk', 'id_produk');
    }
}