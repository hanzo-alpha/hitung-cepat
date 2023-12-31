<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasRegions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tps extends Model
{
    use HasRegions;

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
            $tpsDetails[$this->nama_tps] = $i . ' TPS';
            $tpsDetails[$this->jumlah_tps] = $tps->jumlah_tps ?? $i;

            self::updateOrCreate([
                'nama_tps' => $tpsDetails[$this->nama_tps],
                'kabupaten' => $tpsDetails[$this->kabupaten],
                'kecamatan' => $tpsDetails[$this->kecamatan],
                'kelurahan' => $tpsDetails[$this->kelurahan],
            ], $tpsDetails);
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
}
