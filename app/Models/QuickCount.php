<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use KodePandai\Indonesia\Models\City;
use KodePandai\Indonesia\Models\District;
use KodePandai\Indonesia\Models\Province;
use KodePandai\Indonesia\Models\Village;

class QuickCount extends Model
{
    use HasFactory;

    protected $fillable = [
        'tps_id',
        'caleg_id',
        'jumlah_suara',
        'persentase',
        'status_suara',
    ];

    public function tps(): BelongsTo
    {
        return $this->belongsTo(Tps::class);
    }

    public function tpsdata(): HasManyThrough
    {
        return $this->hasManyThrough(DataTps::class, Tps::class);
    }

    public function data_tps(): BelongsTo
    {
        return $this->belongsTo(DataTps::class);
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

    public function caleg(): BelongsToMany
    {
        return $this->belongsToMany(Caleg::class, 'quick_count_caleg');
    }
}
