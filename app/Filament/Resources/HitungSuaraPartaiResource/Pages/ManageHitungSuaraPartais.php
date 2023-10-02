<?php

namespace App\Filament\Resources\HitungSuaraPartaiResource\Pages;

use App\Filament\Resources\HitungSuaraPartaiResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageHitungSuaraPartais extends ManageRecords
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
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            HitungSuaraPartaiResource\Widgets\SuaraPartaiOverview::class,
        ];
    }
}
