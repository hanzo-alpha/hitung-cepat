<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DataTps extends Model
{
    protected $table = 'data_tps';

    protected $fillable = [
        'tps_id',
        'nama_tps',
        'jumlah_suara',
    ];

    public function tps(): BelongsTo
    {
        return $this->belongsTo(Tps::class);
    }

    public function data_tps(): BelongsToMany
    {
        return $this->belongsToMany(Tps::class, 'tps_data_tps');
    }
}
