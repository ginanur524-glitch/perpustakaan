<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        Siswa::create([
            'nama' => 'M. Azfa',
            'kelas' => 'X PPLG 1'
        ]);

        Siswa::create([
            'nama' => 'Hafiz Haekal',
            'kelas' => 'X PPLG 2'
        ]);

        Siswa::create([
            'nama' => 'M. Ghazy',
            'kelas' => 'X PPLG 3'
        ]);

        Siswa::create([
            'nama' => 'Aisyah Nurfadilah',
            'kelas' => 'X PPLG 4'
        ]);

    }
}
