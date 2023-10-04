<?php

declare(strict_types=1);

namespace App\Utilities;

use App\Models\HitungSuaraPartai;
use Faker\Provider\Color;

class Helpers
{
    public static function hitungPresentase(int $nilai, $format = false): float|string
    {
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

    public static function generateColor($item): string
    {
        return Color::hexColor($item);
    }

    public static function hitungPerolehanKursi($suara): float|int|string
    {
        $persen = config('custom.angka_default.ambang_batas');
        $totalSuara = 0;
        if ($suara > 0) {
            $totalSuara = $suara * $persen;
        }

        return $totalSuara;
    }

    /*
     * Ada 3 tahapan yang akan dilalui dalam penentuan perolehan kursi parpol.
     * Tahapan pertama adalah 100 persen BPP (Bilangan Pembagi Pemilih),
     * tahap kedua adalah 50 persen BPP,
     * tahap ketiga adalah BPP baru dengan cara suara dan kursi sisa ditarik ke provinsi.
    */

    public static function hitungBpp($suara = 0, $totalkursi = 0): float|int|string
    {
        $totalSuara = 0;
        $kursi = 0;

        $totalSuara = $suara > 0 ? ($suara / $totalkursi) : 0;

        $kursi = ($suara - $totalSuara) / $totalSuara;

        return $kursi ?? 0;
    }

    /**
     * Perhitungan Nilai parliamentary threshold (PT)
     * Dilakukan terlebih dahulu untuk menghitung perolehan suara/kursi partai
     * Berdasarkan suara sah nasional. Partai yang tidak lolos tahap ini
     * Tidak diperbolehkan dalam perhitungan kursi partai.
     */
    public static function hitungParliamentaryThreshold($suarasah): float|int|string
    {
        $persenPT = config('custom.angka_default.parliamentary_threshold');
        $nilaiPT = ($suarasah / $persenPT) ?? 0;

        return $nilaiPT;
    }

    public static function hitungPerolehanKursiPartai($suara, $kursiDapil = 0): void
    {
        $kursiDapil = max($kursiDapil, 0);
        $kursiTetap = 0;

        $hitungSuaraPartai = HitungSuaraPartai::query()->with('partai')
            ->get()
            ->filter()
            ->map(function ($item) use ($kursiDapil) {
                $alokasiKursi = 1;
                $kursiDapil = 5;
                $arr['nama_partai'] = $item->partai->nama_partai;
                $arr['suara_partai'] = 36000;
                $arr['jumlah_dapil'] = $kursiDapil ?? $item->jumlah_dapil;
                $arr['jumlah_kursi'] = 5;
                $bilangan = static::bilanganPembagi($kursiDapil);
                $suarass = ($arr['suara_partai'] / $bilangan[0]);
                $suarass = $suarass >= $arr['suara_partai'] ? $alokasiKursi : $suarass;
                $kursiTetap = 0;
                $arr['kursi_tetap'] = $kursiTetap;
                dd($arr, $alokasiKursi);
            });
    }

    /*
     * Menggunakan metode sainte lague
     * */

    public static function bilanganPembagi($nilai): \Illuminate\Support\Collection|array
    {
        $ganjil = collect();
        for ($i = 1; $i <= $nilai; $i++) {
            if ($i % 2 !== 0) {
                $ganjil->add($i);
            }
        }

        return $ganjil;
    }

    public static function getStatusSuaraName($value): string
    {
        return match ($value) {
            1 => 'SUARA SAH',
            2 => 'SUARA TIDAK SAH',
            3 => 'SUARA SEMENTARA'
        };
    }

    public static function getNamaJenisKelamin($value, $short = false): string
    {
        if ($short) {
            return match ($value) {
                1 => 'L',
                2 => 'P',
            };
        }

        return match ($value) {
            1 => 'Laki-Laki',
            2 => 'Perempuan',
        };
    }

    public static function number_format_short($n, $precision = 1): string|float|int
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
