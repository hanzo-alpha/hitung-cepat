<?php

namespace App\Filament\Resources\PenggunaResource\Pages;

use App\Filament\Resources\PenggunaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePenggunas extends ManageRecords
{
    protected static string $resource = PenggunaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-o-plus')
                ->successNotificationTitle('Pengguna berhasil ditambahkan'),
        ];
    }
}
