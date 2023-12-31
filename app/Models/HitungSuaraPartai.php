<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HitungSuaraPartai extends Model
{
    use HasFactory;

    protected $table = 'hitung_suara_partai';

    protected $fillable = [
        'partai_id',
        'jenis_pemilihan_id',
        'jumlah_suara_partai',
        'jumlah_dapil',
        'jumlah_kursi',
        'status_hitung',
    ];

    protected $casts = [
        'jumlah_suara_partai' => 'integer',
        'jumlah_dapil' => 'integer',
        'jumlah_kursi' => 'integer',
        'status_hitung' => 'boolean',
    ];

    //    public function partai(): BelongsTo
    //    {
    //        return $this->belongsTo(Partai::class);
    //    }

    public function partai(): HasMany
    {
        return $this->hasMany(SuaraPartai::class);
    }

    public function jenisPemilihan(): BelongsTo
    {
        return $this->belongsTo(JenisPemilihan::class);
    }
}
