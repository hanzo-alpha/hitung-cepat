<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\StatusAktif;
use App\Enums\StatusDaftarPemilih;
use App\Traits\HasWilayah;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarPemilih extends Model
{
    use HasFactory;
    use HasWilayah;

    protected $table = 'daftar_pemilih';

    protected $fillable = [
        'nama_lengkap',
        'nik',
        'no_kk',
        'notelp',
        'alamat',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'kode_pos',
        'status_pemilih',
        'status_daftar',
    ];

    protected $casts = [
        'status_daftar' => StatusAktif::class,
        'status_pemilih' => StatusDaftarPemilih::class,
    ];
}
