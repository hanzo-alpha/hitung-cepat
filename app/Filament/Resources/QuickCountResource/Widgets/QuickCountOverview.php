<?php

namespace App\Filament\Resources\QuickCountResource\Widgets;

use App\Models\QuickCount;
use App\Utilities\Helpers;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class QuickCountOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '10s';

    protected $listeners = ['updateQuickCountOverview' => '$refresh'];

    protected function getStats(): array
    {
        $quickCount = QuickCount::query();

        return [
            Stat::make('CALEG', $quickCount->count())
                ->color('primary')
                ->description('Total Calon Legislatif'),

            Stat::make('SUARA', Helpers::number_format_short($quickCount->sum('jumlah_suara') ?? 0))
                ->color('success')
                ->description('Total Suara Calon'),

            Stat::make('PERSENTASE', $quickCount->avg('persentase') ?? 0)
                ->color('danger')
                ->description('Rata-Rata Persentase Kemenangan'),
        ];
    }
}
