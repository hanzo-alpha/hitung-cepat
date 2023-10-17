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
        $jumlahSuara = (int) $quickCount->sum('jumlah_suara');
        $suaraBlmMasuk = config('custom.angka_default.total_dpt') - $quickCount->sum('jumlah_suara');

        return [
            Stat::make('CALEG', $quickCount->count())
                ->color('primary')
                ->description('Total Semua Calon'),

            Stat::make('SUARA MASUK', Helpers::shortNumber($jumlahSuara))
                ->color('success')
                ->description('Total Suara Calon'),

            Stat::make('SUARA BELUM MASUK', Helpers::shortNumber($suaraBlmMasuk))
                ->color('success')
                ->description('Total Suara Belum Masuk Calon'),

            Stat::make('PERSENTASE', Helpers::hitungPresentase($jumlahSuara, true) ?? 0)
                ->color('danger')
                ->description('Persentase Suara'),
        ];
    }
}
