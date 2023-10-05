<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\DaftarPemilih;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class DaftarPemilihFactory extends Factory
{
    protected $model = DaftarPemilih::class;

    public function definition(): array
    {
        return [
            'nama_lengkap' => $this->faker->name(), //
            'nik' => '7312' . $this->faker->randomNumber(10),
            'no_kk' => $this->faker->word(),
            'alamat' => $this->faker->address(),
            'notelp' => $this->faker->phoneNumber(),
            'provinsi' => $this->faker->country(),
            'kabupaten' => $this->faker->city(),
            'kecamatan' => $this->faker->word(),
            'kelurahan' => $this->faker->word(),
            'kode_pos' => $this->faker->postcode(),
            'status_pemilih' => $this->faker->numberBetween(0, 1),
            'status_daftar' => $this->faker->numberBetween(1, 2),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
