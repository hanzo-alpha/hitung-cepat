<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use KodePandai\Indonesia\Models\City;
use KodePandai\Indonesia\Models\District;
use KodePandai\Indonesia\Models\Province;
use KodePandai\Indonesia\Models\Village;

class HitungSuara extends Model
{
    protected $table = 'hitung_suara';

    protected $fillable = [
        'tps_id',
        'kandidat_calon_id',
        'jumlah_suara_sah',
        'jumlah_suara_tidak_sah',
        'total_suara',
        'persentase',
        'status_suara',
    ];

    protected $casts = [
        'jumlah_suara_sah' => 'int',
        'jumlah_suara_tidak_sah' => 'int',
        'total_suara' => 'int',
        'persentase' => 'float',
        'status_suara' => 'int',
    ];

    public function tps(): BelongsTo
    {
        return $this->belongsTo(Tps::class);
    }

    public function prov(): HasManyThrough
    {
        return $this->hasManyThrough(Tps::class, Province::class);
    }

    public function kab(): HasManyThrough
    {
        return $this->hasManyThrough(Tps::class, City::class);
    }

    public function kec(): HasManyThrough
    {
        return $this->hasManyThrough(Tps::class, District::class);
    }

    public function kel(): HasManyThrough
    {
        return $this->hasManyThrough(Tps::class, Village::class);
    }

    public function kandidat_calon(): BelongsTo
    {
        return $this->belongsTo(KandidatCalon::class);
    }
}
