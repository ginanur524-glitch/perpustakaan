<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PeminjamanExport implements FromCollection, WithHeadings, WithMapping, WithCustomStartCell, WithEvents
{
    public function collection()
    {
        return Peminjaman::with(['siswa', 'buku'])->get();
    }

    // tabel mulai baris 3
    public function startCell(): string
    {
        return 'A3';
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Siswa',
            'Judul Buku',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Status',
        ];
    }

    public function map($p): array
    {
        static $no = 1;

        return [
            $no++,
            $p->siswa->nama ?? '-',
            $p->buku->judul ?? '-',
            $p->tanggal_pinjam,
            $p->tanggal_kembali ?? '-',
            ucfirst($p->status),
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;

                // Judul
                $sheet->mergeCells('A1:F1');
                $sheet->setCellValue('A1', 'DATA PEMINJAMAN BUKU');
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                    ],
                    'alignment' => [
                        'horizontal' => 'center',
                    ],
                ]);

                // Header bold
                $sheet->getStyle('A3:F3')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);

                // Ambil jumlah baris
                $rowCount = $sheet->getHighestRow();

                // BORDER TABEL
                $sheet->getStyle("A3:F{$rowCount}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);

                // AUTO WIDTH
                foreach (range('A', 'F') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }
}