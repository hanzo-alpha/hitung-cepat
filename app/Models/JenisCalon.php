<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisCalon extends Model
{
    public $timestamps = false;

    protected $table = 'jenis_calon';

    protected $fillable = [
        'jenis_calon',
        'deskripsi',
        'tingkat',
        'alokasi_kursi',
    ];
}
