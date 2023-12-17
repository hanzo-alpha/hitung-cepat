<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Kegiatan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class KegiatanFactory extends Factory
{
    protected $model = Kegiatan::class;

    public function definition(): array
    {
        return [
            'nama_kegiatan' => $this->faker->word(), //
            'deskripsi' => $this->faker->word(),
            'tanggal' => Carbon::now(),
            'relawan_id' => $this->faker->randomNumber(),
            'status_kegiatan' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
