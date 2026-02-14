<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PeminjamanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Peminjaman::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Siswa ID',
            'Buku ID',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Status',
        ];
    }
}
