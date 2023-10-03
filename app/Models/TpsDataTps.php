<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TpsDataTps extends Pivot
{
    protected $table = 'tps_data_tps';

    public function tps(): BelongsTo
    {
        return $this->belongsTo(Tps::class);
    }

    public function data_tps(): BelongsTo
    {
        return $this->belongsTo(DataTps::class);
    }
}
