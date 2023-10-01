<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\HitungSuaraPartai;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class HitungSuaraPartaiFactory extends Factory
{
    protected $model = HitungSuaraPartai::class;

    public function definition(): array
    {
        return [
            'partai_id' => $this->faker->randomNumber(), //
            'jenis_pemilihan_id' => $this->faker->randomNumber(),
            'jumlah_suara_partai' => $this->faker->randomNumber(),
            'jumlah_dapil' => $this->faker->randomNumber(),
            'jumlah_kursi' => $this->faker->randomNumber(),
            'status_hitung' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
