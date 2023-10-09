<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\StatusImport;
use App\Traits\HasRegions;
use Illuminate\Database\Eloquent\Model;

class ImportDaftarPemilih extends Model
{
    use HasRegions;

    protected $table = 'import_daftar_pemilih';

    protected $fillable = [
        'provinsi',
        'kabupaten',
        'jumlah_kecamatan',
        'jumlah_kelurahan',
        'jumlah_tps',
        'jumlah_laki',
        'jumlah_perempuan',
        'total_pemilih',
        'status_import',
        'attachment',
    ];

    protected $casts = [
        'status_import' => StatusImport::class,
    ];
}
