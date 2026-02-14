<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{
    protected $table = 'buku';

    protected $fillable = [
        'judul',
        'stok'
    ];

    // 1 buku bisa dipinjam berkali-kali
    public function peminjaman(): HasMany
    {
        return $this->hasMany(Peminjaman::class, 'buku_id');
    }
}

