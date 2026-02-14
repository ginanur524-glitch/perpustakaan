<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
    'siswa_id',
    'buku_id',
    'tanggal_pinjam',
    'tanggal_kembali',
    'status'
];

    // Peminjaman milik satu siswa
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    // Peminjaman milik satu buku
    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }
}
