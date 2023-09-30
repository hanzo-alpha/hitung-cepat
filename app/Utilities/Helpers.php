<?php

declare(strict_types=1);

namespace App\Utilities;

class Helpers
{
    public static function hitungPresentase(int $nilai, $format = false): float | string
    {
        $persen = (float) 0.01;
        $persentase = (float) 0.0;
        $totalDpt = config('custom.angka_default.total_dpt');

        if ($nilai > 0) {
            $persentase = ($nilai / $totalDpt) * 100;
        }

        if ($format) {
            $persentase = number_format($persentase, 0, ',', '.');
        }

        return $persentase;
    }

    public static function hitungPerolehanKursi($suara): float | int | string
    {
        $persen = config('custom.angka_default.ambang_batas');
        $totalSuara = 0;
        if ($suara > 0) {
            $totalSuara = $suara * $persen;
        }

        return $totalSuara;
    }

    public static function hitungBpp($suara = 0, $totalkursi = 0): float | int | string
    {
        $totalSuara = 0;
        $kursi = 0;

        $totalSuara = $suara > 0 ? ($suara / $totalkursi) : 0;

        $kursi = ($suara - $totalSuara) / $totalSuara;

        return $kursi ?? 0;
    }

    public static function bilanganPembagi($nilai): int
    {
        for ($i = 1; $i <= $nilai; $i++) {
            if ($i % 2 === 0) {
                return $i;
            }
        }

        return $i;
    }

    public static function hitungPerolehanKursiPartai($suara, $kursiDapil = 0)
    {
        $kursiDapil = 5;
    }
}
