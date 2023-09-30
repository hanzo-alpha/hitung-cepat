<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Partai;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartaiFactory extends Factory
{
    protected $model = Partai::class;

    public function definition(): array
    {
        return [
            'no_urut' => $this->faker->randomNumber(1), //
            'nama_partai' => $this->faker->word(),
            'alias' => $this->faker->word(),
            'warna' => $this->faker->hexColor(),
            'logo' => $this->faker->imageUrl(),
        ];
    }
}
