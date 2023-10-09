<?php

declare(strict_types=1);

return [
    'default' => [
        'kodeprov' => '73',
        'kodekab' => '7312',
        'kodepos' => '90861',
    ],
    'nama_tps' => 'TPS',
    'angka_default' => [
        'total_dpt' => 200000,
        'ambang_batas' => 3.5,
        'parliamentary_threshold' => 2.5,
        'batas_pemilih_tps' => 300,
    ],
    'date' => [
        'display_short' => 'D, d M Y',
        'display_short_fulltime' => 'D, d M Y H:i:s',
        'display_long' => 'l, d F Y',
        'display_long_fulltime' => 'l, d F Y H:i:s',
        'db_format' => 'Y-m-d H:i:s',
    ],
    'status' => [
        'suara' => [
            1 => 'SUARA SAH',
            2 => 'SUARA TIDAK SAH',
            3 => 'SUARA SEMENTARA',
        ],
        'aktif' => [
            1 => 'AKTIF',
            0 => 'NON AKTIF',
        ],
        'caleg' => [
            1 => 'PARTAI',
            2 => 'TERDAFTAR',
            3 => 'NON PARTAI',
        ],
        'jenis_kelamin' => [
            1 => 'Laki-Laki',
            2 => 'Perempuan',
        ],
        'pemilih' => [
            1 => 'Pemilih Tetap',
            2 => 'Pemilih Sementara',
        ],
    ],
    'version' => [
        'git' => [
            'remote' => [
                'repository' => env('VERSION_GIT_REMOTE_REPOSITORY'),
            ],
        ],
    ],
];
