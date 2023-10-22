<?php

namespace App\Filament\Resources\HitungSuaraPartaiResource\Widgets;

use App\Models\HitungSuaraPartai;
use App\Utilities\Helpers;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SuaraPartaiOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '10s';

    protected $listeners = ['updateSuaraPartaiOverview' => '$refresh'];

    protected function getStats(): array
    {
        //        $hitungSuaraPartai = HitungSuaraPartai::selectRaw('
        //            count(*) as total,
        //            SUM(jumlah_suara_partai) as suara,
        //            SUM(jumlah_dapil) AS dapil,
        //            SUM(jumlah_kursi) AS kursi
        //        ')->first();

        $hitungSuaraPartai = HitungSuaraPartai::query();
        $totalSuaraPartai = $hitungSuaraPartai->sum('jumlah_suara_partai');

        return [
            Stat::make('PARTAI', $hitungSuaraPartai->count())
                ->color('primary')
                ->description('Total Partai'),

            Stat::make('SUARA', Helpers::number_format_short((int) $totalSuaraPartai))
                ->color('success')
                ->description('Total Suara Partai'),

            Stat::make('DAPIL', $hitungSuaraPartai->sum('jumlah_dapil'))
                ->color('danger')
                ->description('Total Dapil Partai'),

            Stat::make('KURSI', $hitungSuaraPartai->sum('jumlah_kursi'))
                ->color('warning')
                ->description('Total Kursi Partai'),
        ];
    }
}
