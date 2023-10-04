<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasWilayah;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dapil extends Model
{
    use HasFactory;
    use HasWilayah;

    protected $table = 'dapil';

    protected $fillable = [
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'nama_dapil',
        'jumlah_dapil',
        'jumlah_kursi',
    ];

    //    public function prov(): BelongsTo
    //    {
    //        return $this->belongsTo(Province::class, 'provinsi', 'code');
    //    }
    //
    //    public function kab(): BelongsTo
    //    {
    //        return $this->belongsTo(City::class, 'kabupaten', 'code');
    //    }
    //
    //    public function kec(): BelongsTo
    //    {
    //        return $this->belongsTo(District::class, 'kecamatan', 'code');
    //    }
    //
    //    public function kel(): BelongsTo
    //    {
    //        return $this->belongsTo(Village::class, 'kelurahan', 'code');
    //    }
}
