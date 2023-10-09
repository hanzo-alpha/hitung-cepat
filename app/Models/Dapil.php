<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasRegions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dapil extends Model
{
    use HasFactory;
    use HasRegions;

    protected $table = 'dapil';

    protected $fillable = [
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'nama_dapil',
        'jumlah_dapil',
        'jumlah_kursi',
    ];
}
