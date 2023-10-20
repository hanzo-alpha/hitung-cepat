<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KegiatanRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nama_kegiatan' => ['required'],
            'deskripsi' => ['required'],
            'tanggal' => ['required', 'date'],
            'relawan_id' => ['nullable', 'integer'],
            'status_kegiatan' => ['nullable'], //
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
