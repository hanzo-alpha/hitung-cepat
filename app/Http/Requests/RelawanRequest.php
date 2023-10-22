<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RelawanRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nama' => ['required'],
            'umur' => ['nullable', 'integer'],
            'tgl_lahir' => ['required', 'date'],
            'notelp' => ['required'],
            'alamat' => ['required'],
            'kegiatan_id' => ['required', 'integer'],
            'kampanye_id' => ['required', 'integer'],
            'anggaran_id' => ['required', 'integer'],
            'kabupaten' => ['nullable'],
            'kecamatan' => ['nullable'],
            'kelurahan' => ['nullable'],
            'rt_rw' => ['nullable'],
            'kodepos' => ['nullable'],
            'status_relawan' => ['nullable', 'integer'], //
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
