<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\SuaraPartai;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SuaraPartaiFactory extends Factory
{
    protected $model = SuaraPartai::class;

    public function definition(): array
    {
        return [
            'partai_id' => $this->faker->randomNumber(), //
            'jumlah_suara' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
