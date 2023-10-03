<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    protected $casts = [
        'jumlah_tps' => 'integer',
    ];

    public function generateTps(self $tps, $jumlah = 0): void
    {
        $tpsDetails = [
            $this->provinsi => $tps->provinsi,
            $this->kabupaten => $tps->kabupaten,
            $this->kecamatan => $tps->kecamatan,
            $this->kelurahan => $tps->kelurahan,
            $this->jumlah_tps => $tps->jumlah_tps,
        ];

        for ($i = 0; $i <= $jumlah; $i++) {
            $tpsDetails[$this->nama_tps] = 'TPS ' . $i;
            $tpsDetails[$this->jumlah_tps] = $tps->jumlah_tps ?? $i;

            self::create($tpsDetails);
        }
    }

    public function data_tps(): HasMany
    {
        return $this->hasMany(DataTps::class);
    }

    public function dataTps(): BelongsToMany
    {
        return $this->belongsToMany(DataTps::class, 'tps_data_tps');
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
