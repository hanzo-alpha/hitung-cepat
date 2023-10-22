<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\StatusAktif;
use App\Traits\HasRegions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relawan extends Model
{
    use HasFactory;
    use HasRegions;

    protected $table = 'relawan';

    protected $fillable = [
        'nama_relawan',
        'umur',
        'tgl_lahir',
        'notelp',
        'alamat',
        'kegiatan_id',
        'kampanye_id',
        'anggaran_id',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'rt_rw',
        'kodepos',
        'status_relawan',
    ];

    protected $casts = [
        'tgl_lahir' => 'date',
        'status_relawan' => StatusAktif::class,
    ];
}
