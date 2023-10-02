<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Caleg extends Model
{
    use HasFactory;

    protected $table = 'caleg';

    protected $fillable = [
        'nama_caleg',
        'partai_id',
        'jenis_pemilihan_id',
        'jumlah_suara',
        'status_aktif',
    ];

    protected $casts = [
        'status_aktif' => 'boolean',
        'jumlah_suara' => 'integer',
    ];

    public function partai(): BelongsToMany
    {
        return $this->belongsToMany(Partai::class, 'partai_caleg');
    }

    public function jenisPemilihan(): BelongsTo
    {
        return $this->belongsTo(JenisPemilihan::class);
    }
}
