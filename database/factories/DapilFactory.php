<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Dapil;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class DapilFactory extends Factory
{
    protected $model = Dapil::class;

    public function definition(): array
    {
        return [
            'provinsi' => $this->faker->word(), //
            'kabupaten' => $this->faker->word(),
            'kecamatan' => $this->faker->word(),
            'kelurahan' => $this->faker->word(),
            'nama_dapil' => $this->faker->word(),
            'jumlah_dapil' => $this->faker->randomNumber(),
            'jumlah_kursi' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
