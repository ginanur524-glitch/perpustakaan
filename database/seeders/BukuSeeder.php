<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buku;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        Buku::create([
            'judul' => 'Pemrograman Dasar PHP',
            'stok' => 5
        ]);

        Buku::create([
            'judul' => 'Dasar Laravel 12',
            'stok' => 3
        ]);

        Buku::create([
            'judul' => 'Basis Data MySQL',
            'stok' => 4
        ]);
    }
}

