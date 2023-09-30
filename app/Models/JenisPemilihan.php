<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisPemilihan extends Model
{
    protected $table = 'jenis_pemilihan';

    protected $fillable = [
        'nama_institusi',
        'tingkat_pemilihan',
        'jumlah_dapil',
        'jumlah_kursi',
        'total_dapil',
        'total_kursi',
        'deskripsi',
        'status_pemilihan',
    ];

    protected $casts = [
        'jumlah_dapil' => 'integer',
        'jumlah_kursi' => 'integer',
        'total_dapil' => 'integer',
        'total_kursi' => 'integer',
        'status_pemilihan' => 'boolean',
    ];
}
