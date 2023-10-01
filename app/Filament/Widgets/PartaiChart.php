<?php

namespace App\Filament\Widgets;

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

    public ?string $filter = 'today';

    protected int | string | array $columnSpan = 'full';

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'week' => 'Last week',
            'month' => 'Last month',
            'year' => 'This year',
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

        $activeFilter = $this->filter;

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'Total Partai',
                    'data' => [7, 10, 13, 15, 18],
                ],
            ],
            'xaxis' => [
                'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
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
            'colors' => ['#f59e0b'],
            'plotOptions' => [
                'bar' => [
                    'borderRadius' => 3,
                    'horizontal' => false,
                ],
            ],
        ];
    }
}
