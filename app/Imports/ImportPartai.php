<?php

namespace App\Imports;

use App\Models\Partai;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportPartai implements ToModel, WithBatchInserts, WithChunkReading, WithHeadingRow
{
    public function model(array $row): Model | Partai | null
    {
        return new Partai([
            'no_urut' => $row['no_urut'],
            'nama_partai' => $row['nama_partai'],
            'alias' => $row['alias'],
            'warna' => $row['warna'],
        ]);
    }

    public function batchSize(): int
    {
        return 500;
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
