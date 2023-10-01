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

    public static function hitungPerolehanKursiPartai($suara, $kursiDapil = 0): void
    {
        $kursiDapil = 5;
    }

    public static function number_format_short($n, $precision = 1): string | float | int
    {
        if ($n < 900) {
            // 0 - 900
            $n_format = number_format($n, $precision);
            $suffix = '';
        } else {
            if ($n < 900000) {
                // 0.9k-850k
                $n_format = number_format($n / 1000, $precision);
                $suffix = 'K';
            } else {
                if ($n < 900000000) {
                    // 0.9m-850m
                    $n_format = number_format($n / 1000000, $precision);
                    $suffix = 'M';
                } else {
                    if ($n < 900000000000) {
                        // 0.9b-850b
                        $n_format = number_format($n / 1000000000, $precision);
                        $suffix = 'B';
                    } else {
                        // 0.9t+
                        $n_format = number_format($n / 1000000000000, $precision);
                        $suffix = 'T';
                    }
                }
            }
        }

        // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
        // Intentionally does not affect partials, eg "1.50" -> "1.50"
        if ($precision > 0) {
            $dotzero = '.' . str_repeat('0', $precision);
            $n_format = str_replace($dotzero, '', $n_format);
        }

        return $n_format . $suffix;
    }

    public static function shortNumber($num)
    {
        $units = ['', 'K', 'M', 'B', 'T'];
        for ($i = 0; $num >= 1000; $i++) {
            $num /= 1000;
        }

        return round($num, 1) . $units[$i];
    }
}
