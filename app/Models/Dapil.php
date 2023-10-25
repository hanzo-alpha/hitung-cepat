<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasRegions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dapil extends Model
{
    use HasFactory;
    use HasRegions;

    protected $table = 'dapil';

    protected $fillable = [
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'nama_dapil',
        'jenis_pemilihan',
        'daerah_pemilihan',
        'jumlah_dapil',
        'jumlah_kursi',
    ];

    protected $casts = [
        'daerah_pemilihan' => 'array'
    ];

    public function jenisPemilihan(): BelongsTo
    {
        return $this->belongsTo(JenisPemilihan::class);
    }
}
