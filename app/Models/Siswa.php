<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = [
        'nama',
        'kelas'
    ];

    // 1 siswa punya banyak peminjaman
    public function peminjaman(): HasMany
    {
        return $this->hasMany(Peminjaman::class, 'siswa_id');
    }
}
