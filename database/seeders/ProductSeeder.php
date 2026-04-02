<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'nama_tas' => 'Tas Ransel Pria',
                'harga' => 250000,
                'stok' => 10,
                'deskripsi' => 'Tas ransel cocok untuk kerja dan kuliah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tas' => 'Tas Selempang Wanita',
                'harga' => 175000,
                'stok' => 15,
                'deskripsi' => 'Tas stylish untuk kegiatan sehari-hari',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tas' => 'Tas Travel Besar',
                'harga' => 320000,
                'stok' => 5,
                'deskripsi' => 'Cocok untuk perjalanan jauh',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tas' => 'Tas Laptop',
                'harga' => 280000,
                'stok' => 8,
                'deskripsi' => 'Tas khusus laptop dengan pelindung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tas' => 'Tas Mini Fashion',
                'harga' => 120000,
                'stok' => 20,
                'deskripsi' => 'Tas kecil kekinian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}