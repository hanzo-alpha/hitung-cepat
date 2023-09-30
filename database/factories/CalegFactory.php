<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Caleg;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CalegFactory extends Factory
{
    protected $model = Caleg::class;

    public function definition(): array
    {
        return [
            'nama_caleg' => $this->faker->word(), //
            'partai_id' => $this->faker->randomNumber(),
            'jenis_calon_id' => $this->faker->randomNumber(),
            'status_caleg' => $this->faker->word(),
            'status_aktif' => $this->faker->boolean(),
            'jumlah_suara' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
