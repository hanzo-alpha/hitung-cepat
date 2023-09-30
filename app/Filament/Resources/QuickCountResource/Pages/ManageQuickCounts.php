<?php

namespace App\Filament\Resources\QuickCountResource\Pages;

use App\Filament\Resources\QuickCountResource;
use App\Models\QuickCount;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords\Tab;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Enums\IconPosition;
use Illuminate\Database\Eloquent\Builder;

class ManageQuickCounts extends ManageRecords
{
    protected static string $resource = QuickCountResource::class;

    public function getTabs(): array
    {
        return [
            'all' => Tab::make()
                ->badge(QuickCount::query()->count())
                ->badgeColor('info')
                ->icon('heroicon-o-bars-3')
                ->iconSize('xs')
                ->iconPosition(IconPosition::After),
            'Suara Sah' => Tab::make()
                ->badge(QuickCount::query()->where('status_suara', '=', 'SUARA SAH')->count())
                ->badgeColor('success')
                ->icon('heroicon-o-check-circle')
                ->iconSize('xs')
                ->iconPosition(IconPosition::After)
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_suara', '=', 'SUARA SAH')),
            'Suara Tidak Sah' => Tab::make()
                ->badge(QuickCount::query()->where('status_suara', '=', 'SUARA TIDAK SAH')->count())
                ->badgeColor('danger')
                ->icon('heroicon-o-minus-circle')
                ->iconSize('xs')
                ->iconPosition(IconPosition::After)
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_suara', '=', 'SUARA TIDAK SAH')),
            'Suara Sementara' => Tab::make()
                ->badge(QuickCount::query()->where('status_suara', '=', 'SUARA SEMENTARA')->count())
                ->badgeColor('warning')
                ->icon('heroicon-o-pause-circle')
                ->iconSize('xs')
                ->iconPosition(IconPosition::After)
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_suara', '=', 'SUARA SEMENTARA')),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
