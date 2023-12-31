<?php

namespace App\Filament\Resources\HitungSuaraPartaiResource\Pages;

use App\Filament\Resources\HitungSuaraPartaiResource;
use App\Utilities\Helpers;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageHitungSuaraPartai extends ManageRecords
{
    protected static string $resource = HitungSuaraPartaiResource::class;

    //    public function getTabs(): array
    //    {
    //        return [
    //            'Semua' => Tab::make()
    //                ->badge(HitungSuaraPartai::query()->count())
    //                ->badgeColor('info')
    //                ->icon('heroicon-o-bars-3')
    //                ->iconSize('xs')
    //                ->iconPosition(IconPosition::After),
    //            'AKTIF' => Tab::make()
    //                ->badge(HitungSuaraPartai::query()->where('status_hitung', '=', 1)->count())
    //                ->badgeColor('success')
    //                ->icon('heroicon-o-check-circle')
    //                ->iconSize('xs')
    //                ->iconPosition(IconPosition::After)
    //                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_hitung', '=', 1)),
    //            'NON AKTIF' => Tab::make()
    //                ->badge(HitungSuaraPartai::query()->where('status_hitung', '=', 0)->count())
    //                ->badgeColor('danger')
    //                ->icon('heroicon-o-minus-circle')
    //                ->iconSize('xs')
    //                ->iconPosition(IconPosition::After)
    //                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_hitung', '=', 0)),
    //        ];
    //    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->mutateFormDataUsing(function (array $data) {
                    $data['persentase_suara'] = Helpers::hitungPresentase($data['jumlah_suara_partai']);
                    $data['jumlah_dapil'] = 1;

                    return $data;
                })
                ->icon('heroicon-o-plus')
                ->successNotificationTitle('Suara Berhasil Di Tambahkan.'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            //            HitungSuaraPartaiResource\Widgets\SuaraPartaiOverview::class,
        ];
    }
}
