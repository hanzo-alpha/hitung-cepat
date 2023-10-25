<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kegiatan extends Model
{

    protected $table = 'kegiatan';

    protected $fillable = [
        'judul_kegiatan',
        'deskripsi',
        'slug',
        'tanggal',
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
