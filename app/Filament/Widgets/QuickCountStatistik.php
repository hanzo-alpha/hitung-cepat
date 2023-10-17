<?php

namespace App\Filament\Widgets;

use App\Models\Caleg;
use App\Models\HitungSuaraPartai;
use App\Models\Partai;
use App\Models\QuickCount;
use App\Utilities\Helpers;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class QuickCountStatistik extends BaseWidget
{
    protected static ?int $sort = 1;

    protected static ?string $pollingInterval = '10s';

    protected function getStats(): array
    {
        return [
            Stat::make('Calon', Caleg::count() . ' Calon')
                ->description('Total Calon Kandidat')
                ->descriptionIcon('heroicon-m-user')
                ->color('success'),
            Stat::make('Partai', Partai::count() . ' Partai')
                ->description('Total Partai Peserta')
                ->descriptionIcon('heroicon-m-flag')
                ->color('danger'),
            Stat::make('Suara Calon', Helpers::shortNumber((float) QuickCount::sum('jumlah_suara')))
                ->description('Total Jumlah Suara Calon')
                ->descriptionIcon('heroicon-m-calculator')
                ->color('warning'),
            Stat::make('Suara Partai', Helpers::shortNumber((float) HitungSuaraPartai::sum('jumlah_suara_partai')))
                ->description('Total Suara Partai')
                ->descriptionIcon('heroicon-m-calculator')
                ->color('info'),
        ];
    }
}
