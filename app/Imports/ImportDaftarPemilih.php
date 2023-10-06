<?php

namespace App\Imports;

use App\Models\ImportDaftarPemilih as ImportDPT;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportDaftarPemilih implements ToModel, WithBatchInserts, WithChunkReading, WithHeadingRow
{
    public function model(array $row): Model | ImportDPT | null
    {
        return new ImportDPT([
            'provinsi' => $row['provinsi'],
            'kabupaten' => $row['kabupaten'],
            'jumlah_kecamatan' => $row['jumlah_kecamatan'],
            'jumlah_kelurahan' => $row['jumlah_kelurahan'],
            'jumlah_tps' => $row['jumlah_tps'],
            'jumlah_laki' => $row['jumlah_laki'],
            'jumlah_perempuan' => $row['jumlah_perempuan'],
            'total_pemilih' => $row['total'],
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
