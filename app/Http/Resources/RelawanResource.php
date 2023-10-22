<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Relawan */
class RelawanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'umur' => $this->umur,
            'tgl_lahir' => $this->tgl_lahir,
            'notelp' => $this->notelp,
            'alamat' => $this->alamat,
            'kegiatan_id' => $this->kegiatan_id,
            'kampanye_id' => $this->kampanye_id,
            'anggaran_id' => $this->anggaran_id,
            'kabupaten' => $this->kabupaten,
            'kecamatan' => $this->kecamatan,
            'kelurahan' => $this->kelurahan,
            'rt_rw' => $this->rt_rw,
            'kodepos' => $this->kodepos,
            'status_relawan' => $this->status_relawan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at, //
        ];
    }
}
