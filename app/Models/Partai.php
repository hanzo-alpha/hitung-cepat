<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    public function calon(): BelongsToMany
    {
        return $this->belongsToMany(KandidatCalon::class, 'partai_calon');
    }

    public function caleg(): BelongsToMany
    {
        return $this->belongsToMany(Caleg::class, 'partai_caleg');
    }
}
