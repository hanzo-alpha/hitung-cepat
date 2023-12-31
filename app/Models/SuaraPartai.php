<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuaraPartai extends Model
{
    use HasFactory;

    protected $table = 'suara_partai';

    protected $guarded = [];

    public function partai(): BelongsTo
    {
        return $this->belongsTo(Partai::class);
    }
}
