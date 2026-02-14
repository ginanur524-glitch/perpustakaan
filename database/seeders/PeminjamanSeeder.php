<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Peminjaman;

class PeminjamanSeeder extends Seeder
{
    public function run(): void
    {
        Peminjaman::create([
            'siswa_id' => 1,
            'buku_id' => 1,
            'tanggal_pinjam' => now(),
            'status' => 'dipinjam'
        ]);
    }
}
