<?php

namespace App\Filament\Resources\PartaiResource\Pages;

use App\Filament\Resources\PartaiResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePartais extends ManageRecords
{
    protected static string $resource = PartaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-o-plus')
                ->successNotificationTitle('Partai berhasil ditambahkan'),
        ];
    }
}
