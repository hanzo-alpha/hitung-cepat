<?php

namespace App\Filament\Widgets;

use App\Models\HitungSuaraPartai;
use Illuminate\Database\Eloquent\Builder;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class PartaiChart extends ApexChartWidget
{
    /**
     * Chart Id
     */
    protected static string $chartId = 'partaiChart';

    /**
     * Widget Title
     */
    protected static ?string $heading = 'Partai Chart';

    protected static ?int $contentHeight = 300;

    protected static ?string $pollingInterval = '10s'; //px

    protected static bool $deferLoading = true;

    protected static ?string $loadingIndicator = 'Sedang memuat...';

    protected static ?int $sort = 2;

    public ?string $filter = 'all';

    protected int | string | array $columnSpan = 'full';

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Hari Ini',
            'week' => 'Minggu Lalu',
            'month' => 'Bulan Lalu',
            'year' => 'Tahun Ini',
            'all' => 'Semua',

        ];
    }

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     */
    protected function getOptions(): array
    {
        //showing a loading indicator immediately after the page load
        if (! $this->readyToLoad) {
            return [];
        }

        //slow query
        sleep(2);

        $filter = match ($this->filter) {
            'today' => today(),
            'week' => today()->subWeek(),
            'month' => today()->subMonth(),
            'year' => today()->subYear(),
            default => ''
        };

        $hitung = HitungSuaraPartai::query()
            ->when($filter, function (Builder $query) use ($filter) {
                $query->where('created_at', $filter);
            })
            ->with('partai')->get();
        $partai = $hitung->map(function ($item, $key) {
            $dta = [];
            $dta['nama_partai'] = $item->partai->nama_partai;
            $dta['suara'] = $item->jumlah_suara_partai;
            $dta['warna'] = $item->partai->warna;

            return $dta;
        });

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'Total Suara',
                    'data' => \Arr::map($partai->toArray(), static fn ($item) => $item['suara']),
                ],
            ],
            'xaxis' => [
                'categories' => \Arr::map($partai->toArray(), static fn ($item) => $item['nama_partai']),
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => \Arr::map($partai->toArray(), static fn ($item) => $item['warna']),
            'plotOptions' => [
                'bar' => [
                    'borderRadius' => 3,
                    'horizontal' => false,
                ],
            ],
        ];
    }
}
