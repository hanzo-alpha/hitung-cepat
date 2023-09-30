<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\QuickCount;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class QuickCountFactory extends Factory
{
    protected $model = QuickCount::class;

    public function definition(): array
    {
        return [
            'tps_id' => $this->faker->randomNumber(),
            'caleg_id' => $this->faker->randomNumber(),
            'jumlah_suara' => $this->faker->randomNumber(),
            'persentase' => $this->faker->randomFloat(),
            'status_suara' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
