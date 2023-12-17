<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Kegiatan */
class KegiatanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama_kegiatan' => $this->nama_kegiatan,
            'deskripsi' => $this->deskripsi,
            'tanggal' => $this->tanggal,
            'relawan_id' => $this->relawan_id,
            'status_kegiatan' => $this->status_kegiatan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at, //
        ];
    }
}
