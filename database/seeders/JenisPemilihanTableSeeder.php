<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class JenisPemilihanTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('jenis_pemilihan')->delete();

        \DB::table('jenis_pemilihan')->insert([
            0 => [
                'id' => 1,
                'nama_institusi' => 'DPR RI',
                'tingkat_pemilihan' => 'Nasional',
                'jumlah_dapil' => 84,
                'jumlah_kursi' => 580,
                'total_dapil' => 0,
                'total_kursi' => 0,
                'deskripsi' => 'Dewan Perwakilan Rakyat Republik Indonesia (DPR RI)',
                'created_at' => '2023-10-01 05:55:48',
                'updated_at' => '2023-10-01 05:55:48',
                'status_pemilihan' => 1,
            ],
            1 => [
                'id' => 2,
                'nama_institusi' => 'DPD',
                'tingkat_pemilihan' => 'Nasional',
                'jumlah_dapil' => 0,
                'jumlah_kursi' => 0,
                'total_dapil' => 0,
                'total_kursi' => 0,
                'deskripsi' => 'Dewan Perwakilan Daerah (DPD)',
                'created_at' => '2023-10-01 05:56:10',
                'updated_at' => '2023-10-01 05:56:10',
                'status_pemilihan' => 1,
            ],
            2 => [
                'id' => 3,
                'nama_institusi' => 'DPRD I',
                'tingkat_pemilihan' => 'Provinsi',
                'jumlah_dapil' => 301,
                'jumlah_kursi' => 2372,
                'total_dapil' => 0,
                'total_kursi' => 0,
                'deskripsi' => 'Dewan Perwakilan Rakyat Daerah I (DPRD I)',
                'created_at' => '2023-10-01 05:56:54',
                'updated_at' => '2023-10-01 05:56:54',
                'status_pemilihan' => 1,
            ],
            3 => [
                'id' => 4,
                'nama_institusi' => 'DPRD II',
                'tingkat_pemilihan' => 'Kabupaten/Kota',
                'jumlah_dapil' => 2325,
                'jumlah_kursi' => 17510,
                'total_dapil' => 0,
                'total_kursi' => 0,
                'deskripsi' => 'Dewan Perwakilan Rakyat Daerah II (DPRD II)',
                'created_at' => '2023-10-01 05:57:29',
                'updated_at' => '2023-10-01 05:57:29',
                'status_pemilihan' => 1,
            ],
            4 => [
                'id' => 5,
                'nama_institusi' => 'PRESIDEN RI',
                'tingkat_pemilihan' => 'Indonesia',
                'jumlah_dapil' => 0,
                'jumlah_kursi' => 1,
                'total_dapil' => 0,
                'total_kursi' => 0,
                'deskripsi' => 'Pemilihan Presiden RI',
                'created_at' => '2023-10-09 02:52:22',
                'updated_at' => '2023-10-09 02:52:22',
                'status_pemilihan' => 1,
            ],
        ]);

    }
}
