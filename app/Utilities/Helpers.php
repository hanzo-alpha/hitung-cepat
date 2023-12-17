<?php

declare(strict_types=1);

namespace App\Utilities;

use App\Models\HitungSuaraPartai;
use Carbon\Carbon;
use DateTime;
use Faker\Provider\Color;

class Helpers
{
    public static function hitungPresentase(int $nilai, $format = false): float | string | int
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

    public static function hitungPerolehanKursi($suara): float | int | string
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

    public static function hitungBpp($suara = 0, $totalkursi = 0): float | int | string
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
    public static function hitungParliamentaryThreshold($suarasah): float | int | string
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

    public static function bilanganPembagi($nilai): \Illuminate\Support\Collection | array
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

    public static function shortNumber($num): string | float | int
    {
        $units = ['', 'K', 'M', 'B', 'T'];
        for ($i = 0; $num >= 1000; $i++) {
            $num /= 1000;
        }

        return round($num, 1) . $units[$i];
    }

    public static function hitungUmur($date)
    {
        $tanggal_lahir = date('Y-m-d', strtotime('1995-06-13'));

        $birthDate = new DateTime($tanggal_lahir);
        $today = new DateTime('today');
        if ($birthDate > $today) {
            exit('0 tahun 0 bulan 0 hari');
        }
        $y = $today->diff($birthDate)->y;
        // dd($y);
        $m = $today->diff($birthDate)->m;
        $d = $today->diff($birthDate)->d;

        return $y . ' tahun ' . $m . ' bulan ' . $d . ' hari';
    }

    public static function getUmur($date, $format = false): int | string
    {
        $now = Carbon::now(); // Tanggal sekarang
        $date = ($date instanceof Carbon) ? $date : Carbon::parse($date)->format('Y-m-d');
        $b_day = Carbon::parse($date); // Tanggal Lahir
        $age = $b_day->diffInYears($now);  // Menghitung umur

        if ($format) {
            return 'Umurnya Adalah ' . $age . ' Tahun'; // 6 Th
        }

        return $age;
    }

    /**
     * Menghitung hak jumlah kursi di parlemen sesuai dengan jumlah suara di daerah pemilihan
     *
     * @param  number  $kursi  jumlah kursi yang akan di distribusikan di dapil
     * @param  array  $data  data jumlah suara per label partai
     * @return array jumlah kursi per label partai
     */
    public static function saintlague($kursi, array $data): array
    {
        // Map data menjadi struktur yang memiliki jumlah kursi
        $hasil = array_map(static function ($d) {
            return ['label' => $d['label'], 'kursi' => 0];
        }, $data);

        // Pengulangan sesuai jumlah kursi
        for ($i = 0; $i < $kursi; $i++) {
            // Variable untuk menampung informasi kalkulasi pembagian suara sementara
            $kalkulasiPembagian = [];

            // Pengulangan data jumlah suara per partai
            foreach ($data as $j => $d) {
                // Jumlah suara partai (ke-i) dibagi dengan angka ganjil tergantung dengan jumlah kursi yang sudah didapatkan
                // dengan formula : jumlah kursi sementara * 2 + 1
                $nilai = $d['suara'] / (($hasil[$j]['kursi'] * 2) + 1);
                // Nilai pembagian di-push di variable kalkulasiPembagian
                $kalkulasiPembagian[] = ['suara' => $nilai];
            }

            // Menemukan index partai dengan jumlah suara terbesar sementara
            $indexTerbesar = static::terbesar($kalkulasiPembagian);
            // Menambah kursi ke partai yang memiliki suara terbesar
            $hasil[$indexTerbesar]['kursi']++;
        }

        // Mengembalikan hasil
        return $hasil;
    }

    /**
     * Menemukan index item dengan suara terbesar pada data hasil kalkulasi pembagian suara sementara
     *
     * @param  array  $data  data kalkulasi pembagian suara sementara
     * @return number index item dengan suara terbesar
     */
    public static function terbesar(array $data): int
    {
        // Set nilai terbesar menjadi jumlah suara partai pertama
        $terbesar = $data[0]['suara'];
        // Set index menjadi index partai pertama
        $index = 0;

        // Pengulangan data kalkulasi pembagian suara per partai sementara
        foreach ($data as $i => $d) {
            // Jika nilai suara partai (ke-i) lebih besar daripada nilai variable suara terbesar terakhir
            if ($d['suara'] > $terbesar) {
                // Set index (ke-i)
                $index = $i;
                // Set nilai variable suara terbesar menjadi partai (ke-i)
                $terbesar = $d['suara'];
            }
        }

        // Mengembalikan nilai index
        return $index;
    }

    // USAGE
    // $parlemen = saintLague(5, [
    //     ['label' => 'A', 'suara' => 64000],
    //     ['label' => 'B', 'suara' => 18000],
    //     ['label' => 'C', 'suara' => 15000],
    //     ['label' => 'D', 'suara' => 8600],
    //     ['label' => 'E', 'suara' => 8000],
    //     ['label' => 'F', 'suara' => 7600]
    // ]);
    // var_dump($parlemen);
}
