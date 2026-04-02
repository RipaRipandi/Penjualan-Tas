<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\ProductSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        // Panggil ProductSeeder
        $this->call(ProductSeeder::class);
        $this->call(userseeder::class);
    }
}