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

    protected $fillable = [
        'nama_caleg',
        'partai_id',
        'jenis_calon_id',
        'status_caleg',
        'status_aktif',
        'jumlah_suara',
    ];

    protected $casts = [
        'status_aktif' => 'boolean',
        'jumlah_suara' => 'integer',
    ];

    public function partai(): BelongsToMany
    {
        return $this->belongsToMany(Partai::class, 'partai_caleg');
    }

    public function partais(): BelongsTo
    {
        return $this->belongsTo(Partai::class);
    }

    public function jenis_calon(): BelongsTo
    {
        return $this->belongsTo(JenisCalon::class);
    }
}
