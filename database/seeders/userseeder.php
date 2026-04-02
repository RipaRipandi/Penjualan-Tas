<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
    'nama' => 'Admin',
    'email' => 'admin@gmail.com',
    'password' => bcrypt('123456'),
    'alamat' => 'Admin Address',
    'role' => 'admin'
]);

User::create([
    'nama' => 'User Biasa',
    'email' => 'user@gmail.com',
    'password' => bcrypt('123456'),
    'alamat' => 'User Address',
    'role' => 'user'
]);
    }
}
