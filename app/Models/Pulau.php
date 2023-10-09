<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Pulau extends Model
{
    public $timestamps = false;

    protected $table = 'pulau';

    protected $primaryKey = 'code';

    protected $fillable = [
        'provinsi_code',
        'kabupaten_code',
        'name',
    ];

    public function provinsi(): BelongsTo
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_code');
    }

    public function kabupaten(): BelongsTo
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_code');
    }

    public function kecamatan(): HasOneThrough
    {
        return $this->hasOneThrough(
            Kecamatan::class,
            Kabupaten::class,
            'code',
            'kabupaten_code',
            'kabupaten_code',
            'code'
        );
    }

    public function kelurahan(): HasManyThrough
    {
        return $this->hasManyThrough(Kelurahan::class, Kabupaten::class);
    }
}
