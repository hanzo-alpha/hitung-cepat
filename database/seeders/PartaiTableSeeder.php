<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PartaiTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('partai')->delete();

        \DB::table('partai')->insert([
            0 => [
                'id' => 1,
                'no_urut' => 1,
                'nama_partai' => 'Partai Kebangkitan Bangsa',
                'alias' => 'PKB',
                'warna' => '#8eeb89',
                'logo' => null,
            ],
            1 => [
                'id' => 2,
                'no_urut' => 2,
                'nama_partai' => 'Partai Gerakan Indonesia Raya',
                'alias' => 'Partai GERINDRA',
                'warna' => '#4b3fd4',
                'logo' => null,
            ],
            2 => [
                'id' => 3,
                'no_urut' => 3,
                'nama_partai' => 'Partai Demokrasi Indonesia Perjuangan',
                'alias' => 'PDI PERJUANGAN',
                'warna' => '#f21f3f',
                'logo' => null,
            ],
            3 => [
                'id' => 4,
                'no_urut' => 4,
                'nama_partai' => 'Partai Golongan Karya',
                'alias' => 'Partai GOLKAR',
                'warna' => '#e4ed33',
                'logo' => null,
            ],
            4 => [
                'id' => 5,
                'no_urut' => 5,
                'nama_partai' => 'Partai Nasdem',
                'alias' => 'NASDEM',
                'warna' => '#a63a9e',
                'logo' => null,
            ],
            5 => [
                'id' => 6,
                'no_urut' => 6,
                'nama_partai' => 'Partai Buruh',
                'alias' => 'PB',
                'warna' => '#9ed641',
                'logo' => null,
            ],
            6 => [
                'id' => 7,
                'no_urut' => 7,
                'nama_partai' => 'Partai Gelombang Rakyat Indonesia',
                'alias' => 'GELORA INDONESIA',
                'warna' => '#000000',
                'logo' => null,
            ],
            7 => [
                'id' => 8,
                'no_urut' => 8,
                'nama_partai' => 'Partai Keadilan Sejahtera',
                'alias' => 'PKS',
                'warna' => '#c42c2c',
                'logo' => null,
            ],
            8 => [
                'id' => 9,
                'no_urut' => 9,
                'nama_partai' => 'Partai Kebangkitan Nusantara',
                'alias' => 'PKN',
                'warna' => '#5e612c',
                'logo' => null,
            ],
            9 => [
                'id' => 10,
                'no_urut' => 10,
                'nama_partai' => 'Partai Hati Nurani Rakyat',
                'alias' => 'HANURA',
                'warna' => '#3eaebd',
                'logo' => null,
            ],
            10 => [
                'id' => 11,
                'no_urut' => 11,
                'nama_partai' => 'Partai Garda Perubahan Indonesia',
                'alias' => 'GARUDA',
                'warna' => '#4abccc',
                'logo' => null,
            ],
            11 => [
                'id' => 12,
                'no_urut' => 12,
                'nama_partai' => 'Partai Amanat Nasional',
                'alias' => 'PAN',
                'warna' => '#468af0',
                'logo' => null,
            ],
            12 => [
                'id' => 13,
                'no_urut' => 13,
                'nama_partai' => 'Partai Bulan Bintang',
                'alias' => 'PBB',
                'warna' => '#41ba36',
                'logo' => null,
            ],
            13 => [
                'id' => 14,
                'no_urut' => 14,
                'nama_partai' => 'Partai Demokrat',
                'alias' => 'DEMOKRAT',
                'warna' => '#1e53d9',
                'logo' => null,
            ],
            14 => [
                'id' => 15,
                'no_urut' => 15,
                'nama_partai' => 'Partai Solidaritas Indonesia',
                'alias' => 'PSI',
                'warna' => '#e80e0e',
                'logo' => null,
            ],
            15 => [
                'id' => 16,
                'no_urut' => 16,
                'nama_partai' => 'Partai Persatuan Indonesia',
                'alias' => 'PERINDO',
                'warna' => '#40adc9',
                'logo' => null,
            ],
            16 => [
                'id' => 17,
                'no_urut' => 17,
                'nama_partai' => 'Partai Persatuan Pembangunan',
                'alias' => 'PPP',
                'warna' => '#cfa64b',
                'logo' => null,
            ],
            17 => [
                'id' => 18,
                'no_urut' => 18,
                'nama_partai' => 'Partai Nanggroe Aceh',
                'alias' => 'PNA',
                'warna' => '#886ce6',
                'logo' => null,
            ],
            18 => [
                'id' => 19,
                'no_urut' => 19,
                'nama_partai' => 'Partai Generasi Atjeh Beusaboh Tha\'at Dan Taqwa',
                'alias' => 'GABTHAT',
                'warna' => '#c42685',
                'logo' => null,
            ],
            19 => [
                'id' => 20,
                'no_urut' => 20,
                'nama_partai' => 'Partai Darul Aceh',
                'alias' => 'PDA',
                'warna' => '#c2612b',
                'logo' => null,
            ],
            20 => [
                'id' => 21,
                'no_urut' => 21,
                'nama_partai' => 'Partai Aceh',
                'alias' => 'PA',
                'warna' => '#8fe34d',
                'logo' => null,
            ],
            21 => [
                'id' => 22,
                'no_urut' => 22,
                'nama_partai' => 'Partai Adil Sejahtera Aceh',
                'alias' => 'PAS ACEH',
                'warna' => '#4ad4a6',
                'logo' => null,
            ],
            22 => [
                'id' => 23,
                'no_urut' => 23,
                'nama_partai' => 'Partai Soliditas Independen Rakyat Aceh',
                'alias' => 'SIRA',
                'warna' => '#229c27',
                'logo' => null,
            ],
            23 => [
                'id' => 24,
                'no_urut' => 24,
                'nama_partai' => 'Partai Ummat',
                'alias' => 'Partai Ummat',
                'warna' => '#de2c97',
                'logo' => null,
            ],
            24 => [
                'id' => 25,
                'no_urut' => 25,
                'nama_partai' => 'Independen',
                'alias' => 'IDP',
                'warna' => '#e65cd8',
                'logo' => null,
            ],
        ]);

    }
}
