<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Relawan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RelawanFactory extends Factory
{
    protected $model = Relawan::class;

    public function definition(): array
    {
        return [
            'nama' => $this->faker->word(), //
            'umur' => $this->faker->randomNumber(),
            'tgl_lahir' => Carbon::now(),
            'notelp' => $this->faker->word(),
            'alamat' => $this->faker->word(),
            'kegiatan_id' => $this->faker->randomNumber(),
            'kampanye_id' => $this->faker->randomNumber(),
            'anggaran_id' => $this->faker->randomNumber(),
            'kabupaten' => $this->faker->word(),
            'kecamatan' => $this->faker->word(),
            'kelurahan' => $this->faker->word(),
            'rt_rw' => $this->faker->word(),
            'kodepos' => $this->faker->word(),
            'status_relawan' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
