<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Partai extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'partai';

    protected $fillable = [
        'no_urut',
        'nama_partai',
        'alias',
        'warna',
        'logo',
    ];

    public function hitung_suara_partai(): BelongsTo
    {
        return $this->belongsTo(HitungSuaraPartai::class);
    }

    public function caleg(): BelongsToMany
    {
        return $this->belongsToMany(Caleg::class, 'partai_caleg');
    }

    public function quick_count()
    {
        return $this->belongsTo(QuickCount::class);
    }
}
