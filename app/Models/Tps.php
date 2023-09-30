<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use KodePandai\Indonesia\Models\City;
use KodePandai\Indonesia\Models\District;
use KodePandai\Indonesia\Models\Province;
use KodePandai\Indonesia\Models\Village;

class Tps extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'nama_tps',
        'data_tps_id',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'jumlah_tps',
        'keterangan',
    ];

    public function data_tps(): HasMany
    {
        return $this->hasMany(DataTps::class);
    }

    public function prov(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'provinsi', 'code');
    }

    public function kab(): BelongsTo
    {
        return $this->belongsTo(City::class, 'kabupaten', 'code');
    }

    public function kec(): BelongsTo
    {
        return $this->belongsTo(District::class, 'kecamatan', 'code');
    }

    public function kel(): BelongsTo
    {
        return $this->belongsTo(Village::class, 'kelurahan', 'code');
    }
}
