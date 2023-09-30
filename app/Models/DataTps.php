<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataTps extends Model
{
    protected $table = 'data_tps';

    protected $fillable = [
        'nama_tps',
        'jumlah_suara',
    ];

    public function tps(): BelongsTo
    {
        return $this->belongsTo(Tps::class);
    }
}
