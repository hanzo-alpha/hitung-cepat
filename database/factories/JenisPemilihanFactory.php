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
            'institusi' => $this->faker->word(), //
            'tingkat' => $this->faker->word(),
            'jumlah_kursi' => $this->faker->randomNumber(),
        ];
    }
}
