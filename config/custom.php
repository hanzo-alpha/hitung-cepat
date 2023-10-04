<?php

declare(strict_types=1);

return [
    'default' => [
        'kodeprov' => '73',
        'kodekab' => '7312',
        'kodepos' => '90861',
    ],
    'angka_default' => [
        'total_dpt' => 200000,
        'ambang_batas' => 3.5,
        'parliamentary_threshold' => 2.5,
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
            'SUARA SAH' => 'SUARA SAH',
            'SUARA TIDAK SAH' => 'SUARA TIDAK SAH',
            'SUARA SEMENTARA' => 'SUARA SEMENTARA',
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
    ],
    'version' => [
        'git' => [
            'remote' => [
                'repository' => env('VERSION_GIT_REMOTE_REPOSITORY'),
            ],
        ],
    ],
];
