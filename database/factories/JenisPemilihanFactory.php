<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\JenisPemilihan;
use Illuminate\Database\Eloquent\Factories\Factory;

class JenisPemilihanFactory extends Factory
{
    protected $model = JenisPemilihan::class;

    public function definition(): array
    {
        return [
            'nama_institusi' => $this->faker->company(), //
            'tingkat_pemilihan' => $this->faker->companySuffix(),
            'jumlah_dapil' => $this->faker->randomNumber(),
            'jumlah_kursi' => $this->faker->randomNumber(),
            'total_dapil' => $this->faker->randomNumber(),
            'total_kursi' => $this->faker->randomNumber(),
            'deskripsi' => $this->faker->text(200),
        ];
    }
}
