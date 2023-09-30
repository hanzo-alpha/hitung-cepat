<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class KandidatCalon extends Model
{
    public $timestamps = false;

    protected $table = 'kandidat_calon';

    protected $fillable = [
        'partai_id',
        'nama_kandidat_1',
        'nama_kandidat_2',
        'jenis_calon_id',
        'status_kandidat',
    ];

    protected $casts = [
        'status_kandidat' => 'boolean',
    ];

    //    public function partai(): BelongsTo
    //    {
    //        return $this->belongsTo(Partai::class);
    //    }

    public function partai(): BelongsToMany
    {
        return $this->belongsToMany(Partai::class, 'partai_calon');
    }

    public function jenis_calon(): BelongsTo
    {
        return $this->belongsTo(JenisCalon::class);
    }
}
