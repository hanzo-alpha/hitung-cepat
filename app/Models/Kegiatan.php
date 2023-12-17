<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';

    protected $fillable = [
        'nama_kegiatan',
        'deskripsi',
        'tanggal',
        'relawan_id',
        'status_kegiatan',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
    ];

    public function relawan(): BelongsTo
    {
        return $this->belongsTo(Relawan::class);
    }
}
